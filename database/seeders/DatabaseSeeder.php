<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Locations;
use App\Models\UserPlan;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
            ]
        )
        ;
        UserPlan::create(
            [
                'plan_id' => 1,
                'user_id' => 1,
                'plan_name' => 'Plan 1',
                'date' => '2020-07-11',
                'duration' => '1',
            ]
            );

        Locations::create(
            [
                'id' => 1,
                'title' => 'Home',
                'long' => '-0.1275',
                'lat' => '51.5074',
                'plan_id' => 1,
            ]
        
        );

        Locations::create(
            [
                'id' => 2,
                'title' => 'Work',
                'long' => '-0.1275',
                'lat' => '52.5074',
                'plan_id' => 1,
            ]
        );

        Locations::create(
            [
                'id' => 3,
                'title' => 'School',
                'long' => '-1.1275',
                'lat' => '51.5074',
                'plan_id' => 1,
            ]
        );
    }
}


