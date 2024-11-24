<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Task;

class TaskFactory extends Factory
{
    
    protected $model = Task::class;

   
    public function definition(): array
    {
        $project = Project::factory()->create();

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'deadline' => $this->faker->dateTimeBetween($project->start_date, $project->end_date),
            'status' => $this->faker->randomElement(['active', 'inactive', 'done', 'on-hold', 'overdue']),
            'project_id' => $project->id,
        ];
    }
}
