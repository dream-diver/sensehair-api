<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(App::environment('local')){
            $services = Service::all();
            Booking::factory()->count(25)->create()->each(function ($booking) use ($services) {
                $randomServices = $services->random(5);
                $booking->services()->sync($randomServices->pluck('id'));

                // setting booking duration
                $sum = $randomServices->reduce(function ($sum, $service) {
                    return $sum + $service->duration;
                });
                $booking->update(['duration' => $sum]);
            });
        }
    }
}
