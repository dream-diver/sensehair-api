<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
            'name' => 'Admin',
			'email' => 'admin@demo.com',
			'password' => bcrypt('admin@demo.com'),
			// 'division_id' => 0,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now(),
		]);
		$user = User::first();
		$user->assignRole('admin');
        if(App::environment('local')){
            User::factory()->count(25)->create()->each(function($user){
                $user->assignRole('customer');
            });

            User::factory()->count(5)->create()->each(function($user){
                $user->assignRole('stylist');
                $user->update([
                    'avatar_path' => env('APP_URL') . '/hisoka.jpg'
                ]);
            });

            User::factory()->count(5)->create()->each(function($user){
                $user->assignRole('art_director');
                $user->update([
                    'avatar_path' => env('APP_URL') . '/hisoka.jpg'
                ]);
            });
        }
    }
}
