<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    public function definition(): array
    {
        $startDateTime = $this->faker->dateTimeBetween('now', '+1 year');
        $endDateTime = Carbon::instance($startDateTime)->addHour();


        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'location' => $this->faker->address,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
