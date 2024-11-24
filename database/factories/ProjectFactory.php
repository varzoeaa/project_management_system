<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Project;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now'); // random start date within the past year
        $durationOptions = [14, 30, 60]; // durations in days (2 weeks, 1 month, 2 months)
        $duration = $this->faker->randomElement($durationOptions);
        $endDate = (clone $startDate)->modify("+{$duration} days");

        return [
            'name' => $this->faker->title(),
            'description' => $this->faker->text(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'status' => $this->faker->randomElement(['active', 'inactive', 'done', 'on-hold', 'overdue']),
            'client_id' => Client::factory(),
        ];
    }
}
