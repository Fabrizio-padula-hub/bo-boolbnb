<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Braintree\Gateway;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function token()
    {
        $token = $this->gateway->clientToken()->generate();
        return response()->json(['token' => $token]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'payment_method_nonce' => 'required',
            'sponsorship_id' => 'required|exists:sponsorships,id'
        ]);

        $nonce = $request->payment_method_nonce;
        $sponsorship = Sponsorship::find($request->sponsorship_id);
        $amount = $sponsorship->price;

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            return response()->json(['success' => true, 'transaction' => $result->transaction]);
        } else {
            return response()->json(['success' => false, 'error' => $result->message]);
        }
    }
}
