<?php

namespace Database\Seeders;

use App\Models\Promocode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class PromocodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(App::environment('local')){
            Promocode::factory()->count(10)->create();
        }
    }
}
