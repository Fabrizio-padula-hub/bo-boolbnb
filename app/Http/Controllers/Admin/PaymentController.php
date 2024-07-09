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

    public function checkout(Request $request)
    {
        $nonce = $request->payment_method_nonce;
        $sponsorship_id = $request->sponsorship_id;
        $amount = number_format($request->total_price, 2);
        $apartment_id = $request->apartment_id;
        $apartment_slug = $request->apartment_slug;

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            session([
                'apartment_id' => $apartment_id,
                'apartment_slug' => $apartment_slug,
                'sponsorship_id' => $sponsorship_id,
            ]);
            return redirect()->route('admin.apartments.sponsorship', ['apartment' => $apartment_slug]);
        } else {
            return response()->json(['success' => false, 'error' => $result->message]);
        }
    }
}
