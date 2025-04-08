<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartBook>
 */
class CartBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cart_ids = Cart::inRandomOrder()->pluck('id')->toArray();
        $book_ids = Book::inRandomOrder()->pluck('id')->toArray();

        return [
            'cart_id' => $this->faker->randomElement($cart_ids),
            'book_id' => $this->faker->randomElement($book_ids),
            'quantity' => $this->faker->randomNumber(1),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
