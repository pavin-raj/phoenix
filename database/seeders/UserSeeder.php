<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i=0; $i<=5; $i++){
            $user = new User();
            $user['name'] = $faker->name();
            $user['email'] = $faker->unique()->freeEmail();
            $user['password'] = 'My_Pass1';
            $user['role_id'] = $faker->numberBetween(1,5);
            $user->save();
        }
    }
}
