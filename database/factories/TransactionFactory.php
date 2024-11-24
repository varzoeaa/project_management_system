<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transaction_type_id' => \App\Models\TransactionType::factory()->create()->id,
            'amount' => $this->faker->randomNumber(6),
            'description' => $this->faker->sentence,
            'transaction_date' => $this->faker->dateTimeThisYear,
        ];
    }
}
