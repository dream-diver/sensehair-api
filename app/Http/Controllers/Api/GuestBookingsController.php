<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingStoreRequest;
use App\Models\Booking;
use App\Models\Promocode;
use Illuminate\Support\Facades\Mail;
use Dotunj\LaraTwilio\LaraTwilio;
use App\Mail\BookingSuccessful;

class GuestBookingsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingStoreRequest $request)
    {
        $attributes = $request->validated();

        if (isset($attributes['promocode'])) {
            $promocode = Promocode::where('code', $attributes['promocode'])->first();
            if ($promocode) {
                $attributes['charge'] = $attributes['charge'] * ((100 - $promocode->discount) / 100);
                $attributes['promocode_id'] = $promocode->id;
            }
        }
        if (array_key_exists('promocode', $attributes)) {
            unset($attributes['promocode']);
        }

        $services = $attributes['services'];
        unset($attributes['services']);

        $booking = Booking::create($attributes);
        $email = $attributes["email"];
        $message = "You have an appointment with Sense Hair on " . $booking->booking_time->toDateString() . " at " . $booking->booking_time->format('H:i') . " at Central Plaza 12. See you there!";
        if ($request->sendEmailAndSms == true) {
            try {
                Mail::to($email)->send(new BookingSuccessful($booking));
                LaraTwilio::notify($attributes["phone"], $message);
            } catch (\Throwable $th) {
            }
        }
        $booking->services()->sync($services);
        return $booking;
    }
}
