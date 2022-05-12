<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Util\HandleResponse;
use Illuminate\Http\Request;

class BookingPaymentController extends Controller
{
    use HandleResponse;

    public function __construct(){
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function getPaymentIntent(Request $request, Booking $booking)
    {
        $intent =  \Stripe\PaymentIntent::create([
            'amount' => floor($request->amount*100),
            'currency' => 'eur',
            'payment_method_types' => ['ideal'],
        ]);

        $booking->update([
            'stripe_id' => $intent->id,
            'stripe_client_secret' => $intent->client_secret,
        ]);
        return $intent->client_secret;
    }


    public function submitPaymentSuccess(Request $request)
    {
        $intent_id = $request->payment_intent_id;
        $intent = \Stripe\PaymentIntent::retrieve($intent_id);
        if($intent->status == 'succeeded') {
            $booking = Booking::where('stripe_id', $intent_id)->first();
            $booking->update([
                'payment_status' => 'Paid',
            ]);
            return $this->respondOk(['message' => "Succeeded"]);
        } else {
            return $this->respondBad(['message' => "Not Paid Yet"]);
        }
    }
}
