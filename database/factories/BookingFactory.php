<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_time' => Carbon::now()->addDays(rand(0, 59))->addMinutes(rand(0, 22*60)),
            'charge' => $this->faker->randomFloat(null, 10, 100),

            'customer_id' => User::role('customer')->select('id')->get()->random()->id,
            'server_id' => User::role(['stylist', 'art_director'])->select('id')->get()->random()->id,
        ];
    }
}
