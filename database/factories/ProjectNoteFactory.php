<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\ProjectNote;
use App\Models\User;

class ProjectNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectNote::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'title' => $this->faker->sentence(4),
            'text' => $this->faker->text(),
            'user_id' => User::factory(),
        ];
    }
}
