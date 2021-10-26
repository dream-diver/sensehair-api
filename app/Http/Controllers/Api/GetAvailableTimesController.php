<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GetAvailableTimesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        $dateTime = Carbon::parse($request->date);
        $date = $dateTime->toDateString();
        // return $user->bookings;
        $bookinTimes = $user->bookings()
                            ->whereDate('booking_time', $date)
                            ->orderBy('booking_time', 'asc')
                            ->get()
                            ->pluck('booking_time');
        $bookinTimes = $bookinTimes->map(function ($bookingTime) {
            return Carbon::parse($bookingTime)->format("H:i");
        });
        return $bookinTimes;

        // $b = Booking::first();
        // return getType($b->created_at);

        // $c = Carbon::parse($request->date);
        // $c = $c->toDateString();
        // return $c;
    }
}
