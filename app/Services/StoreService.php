<?php

namespace App\Services;

use Spatie\OpeningHours\OpeningHours;

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
}
