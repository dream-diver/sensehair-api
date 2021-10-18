<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stylists = User::role('stylist')->get();
        if(App::environment('local')){
            Service::factory()->count(25)->create()->each(function($service) use ($stylists){
                $stylists->random(3)->each(function($stylist) use ($service) {
                    $stylist->services()->attach($service->id, ['stylist_charge' => (rand(1001, 10001) / 100)]);
                });
            });
        }
    }
}
