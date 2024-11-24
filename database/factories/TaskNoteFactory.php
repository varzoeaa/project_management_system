<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Task;
use App\Models\TaskNote;
use App\Models\User;

class TaskNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaskNote::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'title' => $this->faker->sentence(4),
            'text' => $this->faker->text(),
            'user_id' => User::factory(),
        ];
    }
}
