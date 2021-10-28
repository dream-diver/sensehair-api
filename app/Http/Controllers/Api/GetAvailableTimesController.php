<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Services\StoreService;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\OpeningHours\OpeningHours;
use Spatie\OpeningHours\Time;

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
        // Get datetime of the request
        $dateTime = Carbon::parse($request->date);
        // Get date string of the request
        $date = $dateTime->toDateString();
        // Get duration of the request
        $duration = $request->duration;

        // Get all the bookings of requeted server
        $bookings = $user->bookings()
                            ->whereDate('booking_time', $date)
                            ->orderBy('booking_time', 'asc')
                            ->get();
        // Get all the bookings' start and end time
        $bookingTimes = $bookings->map(function ($booking) {
            $startTime = Carbon::parse($booking->booking_time);
            $endTime = Carbon::parse($booking->booking_time)->addMinutes($booking->duration);
            return [
                'start' => $startTime->format('H:i'),
                'end' => $endTime->format('H:i'),
            ];
        });

        // Get the Store's opening hours
        $openingHours = new StoreService();
        // Get the store's opening and closing time for that day
        $storeOpeningTime = $openingHours->getOpeningHours()->forDate($dateTime)->nextOpen(Time::fromString("00:01"))->format('H:i');
        $storeClosingTime = $openingHours->getOpeningHours()->forDate($dateTime)->nextClose(Time::fromString("00:01"))->format('H:i');

        // Get the Free time range of the server that day
        $availableFreeTimesOfServer = $this->getOpenTimeSlotsOfServer($storeOpeningTime, $storeClosingTime, $bookingTimes, $dateTime);

        $storeOpeningDateTime = Carbon::parse($date . ' ' . $storeOpeningTime . ' GMT');
        $storeClosingDateTime = Carbon::parse($date . ' ' . $storeClosingTime . ' GMT');

        // Prepare times with 15 minutes interval from the store's opening and closing time that day
        $period = new CarbonPeriod($storeOpeningDateTime, '15 minutes', $storeClosingDateTime);

        // Get available time slots of the server for the request
        $availableTimeSlots = [];
        foreach ($period as $item) {
            $cloneItem = $item;
            $start = $cloneItem->format("H:i");
            $end = $cloneItem->addMinutes($duration)->format("H:i");
            $foundOpeningMinutes = $availableFreeTimesOfServer->diffInOpenMinutes(Carbon::parse($date . ' ' . $start .' GMT'), Carbon::parse($date . ' ' . $end . ' GMT'));
            if ($foundOpeningMinutes == $duration) {
                array_push($availableTimeSlots, $start);
            }
        }
        return $availableTimeSlots;
    }

    protected function getOpenTimeSlotsOfServer($openTime, $closeTime, $bookingTimes, $dateTime){
        $allTimesArray = [];
        array_push($allTimesArray, $openTime);
        foreach ($bookingTimes as $bookingTime) {
            array_push($allTimesArray, $bookingTime['start']);
            array_push($allTimesArray, $bookingTime['end']);
        }
        array_push($allTimesArray, $closeTime);

        $allAvailableTimeArray = [];
        for ($i = 0; $i < count($allTimesArray); $i+=2) {
            $start = $allTimesArray[$i];
            $end = $allTimesArray[$i + 1];
            array_push($allAvailableTimeArray, "$start-$end");
        }
        $allAvailableTimeArray = OpeningHours::create([ $dateTime->format('l') => $allAvailableTimeArray ]);

        return $allAvailableTimeArray;
    }
}
