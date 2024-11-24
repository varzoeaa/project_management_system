<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectCategoryFactory extends Factory
{
    protected $model = ProjectCategory::class;

    
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
        ];

    }
}
