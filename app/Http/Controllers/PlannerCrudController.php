<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlannerCrudController extends Controller
{
    public function index() {
        $bookings = Booking::all();

        $events = [];

        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->booking_time)->format('Y-m-d\TH:i:s');
            $end = Carbon::parse($booking->booking_time)->addHour()->format('Y-m-d\TH:i:s');

            $events[] = [
                'title' => optional($booking->server()->first())->name . ' to ' . optional($booking->customer()->first())->name,
                'start' => $start,
                'end' => $end,
                "backgroundColor" => '#EFC050'
            ];

            // dd($booking->server()->get()->first()->name);
        }
        return view('planner', compact('events'));
    }
}
