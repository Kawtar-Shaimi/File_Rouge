<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderBook>
 */
class OrderBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order_ids = Order::inRandomOrder()->pluck('id')->toArray();
        $book_ids = Book::inRandomOrder()->pluck('id')->toArray();

        return [
            'order_id' => $this->faker->randomElement($order_ids),
            'book_id' => $this->faker->randomElement($book_ids),
            'quantity' => $this->faker->numberBetween(1, 10),
            'total' => $this->faker->randomFloat(2, 0, 1000),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
