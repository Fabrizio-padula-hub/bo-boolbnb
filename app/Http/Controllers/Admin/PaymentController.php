<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Carbon\Carbon;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function token($slug)
    {
        $token = $this->gateway->clientToken()->generate();
        return response()->json(['token' => $token]);
    }

    public function checkout(Request $request, $slug)
    {
        // Debug: Verifica i dati inviati
        dd($request->all());

        if (!$request->has(['payment_method_nonce', 'total_price', 'apartment_id', 'sponsorship_ids'])) {
            return response()->json(['success' => false, 'error' => 'Missing required fields']);
        }

        $nonce = $request->payment_method_nonce;
        $amount = number_format($request->total_price, 2);
        $apartment_id = $request->apartment_id;
        $sponsorship_ids = json_decode($request->sponsorship_ids);

        if (empty($sponsorship_ids)) {
            return response()->json(['success' => false, 'error' => 'Invalid sponsorship IDs']);
        }

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            $currentTime = Carbon::now();
            foreach ($sponsorship_ids as $sponsorship_id) {
                $apartment = Apartment::findOrFail($apartment_id);
                $sponsorship = Sponsorship::findOrFail($sponsorship_id);
                $end_time = $currentTime->copy()->addHours($sponsorship->duration);

                $apartment->sponsorships()->attach($sponsorship, ['start_time' => $currentTime, 'end_time' => $end_time]);
                $currentTime = $end_time;
            }

            session([
                'apartment_id' => $apartment_id,
                'sponsorship_ids' => $sponsorship_ids,
            ]);

            return redirect()->route('admin.apartments.sponsorship', ['apartment' => $slug]);
        } else {
            return response()->json(['success' => false, 'error' => $result->message]);
        }
    }
}
