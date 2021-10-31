<?php

namespace App\Services;

use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Spatie\OpeningHours\OpeningHours;
use Spatie\OpeningHours\Time;

class StoreService
{
    protected $openigHours;

    public function __construct()
    {
        $this->openigHours = OpeningHours::create([
            'monday' => ['10:00-19:00'],
            'tuesday' => ['10:00-19:00'],
            'wednesday' => ['10:00-19:00'],
            'thursday' => ['10:00-20:00'],
            'friday' => ['10:00-20:00'],
            'saturday' => ['10:00-18:00'],
            'sunday' => ['10:00-18:00'],
            'exceptions' => [
                '12-24' => ['10:00-18:00'],
                '12-25' => [],
                '12-26' => [],
                '12-31' => ['10:00-18:00'],
                '01-01' => [],
            ],
        ]);
    }

    public function getOpeningHours ()
    {
        return $this->openigHours;
    }

    public function getAvailableTimesOfAServer(User $server, String $dateString, int $duration)
    {
        // Get datetime of the request
        $dateTime = Carbon::parse($dateString);
        // Get date string of the request
        $date = $dateTime->toDateString();

        // Get all the bookings of requeted server
        $bookings = $server->bookings()
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

        // Get the store's opening and closing time for that day
        $storeOpeningTime = $this->getOpeningHours()->forDate($dateTime)->nextOpen(Time::fromString("00:01"))->format('H:i');
        $storeClosingTime = $this->getOpeningHours()->forDate($dateTime)->nextClose(Time::fromString("00:01"))->format('H:i');

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
