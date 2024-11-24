<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Assignee;
use App\Models\Project;
use App\Models\ProjectAssignee;

class ProjectAssigneeFactory extends Factory
{
    protected $model = ProjectAssignee::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'name' => $this->faker->name,
        ];
    }
}
