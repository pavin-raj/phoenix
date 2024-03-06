<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {

        // Define the latitude and longitude ranges for Ernakulam district
        $minLatitude = 9.7833; // Convert from 9°47' to decimal degrees
        $maxLatitude = 10.3;    // Convert from 10°18' to decimal degrees
        $minLongitude = 76.15;  // Convert from 76°9' to decimal degrees
        $maxLongitude = 77;     // Convert from 77°6' to decimal degrees
        return [
            'description' => fake()->paragraph(),
            'user_id' => fake()->numberBetween(1,30),
            'latitude' => mt_rand($minLatitude * 1000000, $maxLatitude * 1000000) / 1000000,
            'longitude' => mt_rand($minLongitude * 1000000, $maxLongitude * 1000000) / 1000000,
            'city' => 'Ernakulam',
            'state' => 'Kerala'
        ];
    }
}
