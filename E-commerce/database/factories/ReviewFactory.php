<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client_ids = User::where('role', 'client')->inRandomOrder()->pluck('id')->toArray();
        $book_ids = Book::inRandomOrder()->pluck('id')->toArray();

        return [
            'uuid' => $this->faker->uuid(),
            'content' => $this->faker->text(),
            'rate' => $this->faker->numberBetween(1, 5),
            'client_id' => $this->faker->randomElement($client_ids),
            'book_id' => $this->faker->randomElement($book_ids),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
