<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionType>
 */
class TransactionTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory()->create()->id,
            'type_name' => $this->faker->randomElement(['expense', 'income']),
            'category' => $this->faker->word,
            'client_name' => null,
        ];
    }
}
