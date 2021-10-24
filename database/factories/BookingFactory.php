<?php

namespace Database\Factories;

use App\Models\Booking;
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
        $hairTypes = ['Men', 'Women Short Hair', 'Medium Hair', 'Long Hair'];
        $hairSizes = ['Straight', 'Wavy', 'Curly', 'Coily'];

        $hairTypeIndex = rand(0, 3);

        return [
            'hair_type' => $hairTypes[$hairTypeIndex],
            'hair_size' => ($hairTypeIndex !== 0) ? $hairSizes[rand(0, 3)] : null,

            'booking_time' => Carbon::now()->addDays(rand(0, 59))->addMinutes(rand(0, 22*60)),

            'customer_id' => User::role('customer')->select('id')->get()->random()->id,
            'stylist_id' => User::role('stylist')->select('id')->get()->random()->id,
        ];
    }
}
