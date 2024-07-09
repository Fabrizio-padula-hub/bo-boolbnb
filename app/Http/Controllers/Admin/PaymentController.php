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
        $request->validate([
            'payment_method_nonce' => 'required',
            'sponsorship_id' => 'required',
            'price' => 'required'
        ]);

        $nonce = $request->payment_method_nonce;
        $amount = $request->price;
        $apartment_id = $request->apartment_id;
        $sponsorship_id = $request->sponsorship_id;
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        session([
            'apartment_id' => $apartment_id,
            'sponsorship_id' => $sponsorship_id
        ]);

        if ($result->success) {
            return redirect()->route('admin.apartments.sponsorship', ['apartment' => $slug]);
        } else {
            return response()->json(['success' => false, 'error' => $result->message]);
        }
    }
}
