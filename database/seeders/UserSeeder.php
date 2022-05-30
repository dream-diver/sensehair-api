<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = User::first();
        $user->assignRole('admin');


        $user = User::create([
            'name' => 'Carlos',
            'email' => 'carlos_kapper@msn.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'avatar_path' => env('APP_URL') . '/images/carlos3.png'
        ]);
        $user->assignRole('art_director');

        $user = User::create([
            'name' => 'Cheyenne',
            'email' => 'cheyenne@msn.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'avatar_path' => env('APP_URL') . '/images/cheyenne.png'
        ]);
        $user->assignRole('stylist');

        $user = User::create([
            'name' => 'Xavier',
            'email' => 'xavier@msn.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'avatar_path' => env('APP_URL') . '/images/xavier.png'
        ]);
        $user->assignRole('stylist');

    }
}
