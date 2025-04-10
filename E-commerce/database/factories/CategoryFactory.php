<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $admin_ids = User::where('role', 'admin')
        ->inRandomOrder()
        ->pluck('id')
        ->toArray();

        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'admin_id' => $this->faker->randomElement($admin_ids),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now')
        ];
    }
}
