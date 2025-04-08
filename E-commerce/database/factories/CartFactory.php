<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client_ids = User::where('role', 'client')
        ->inRandomOrder()
        ->pluck('id')
        ->toArray();

        return [
            'uuid' => $this->faker->uuid(),
            'client_id' => $this->faker->randomElement($client_ids),
            'total_price' => $this->faker->randomFloat(2, 0, 1000),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
