<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WishlistBook>
 */
class WishlistBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $wishlist_ids = Wishlist::inRandomOrder()->pluck('id')->toArray();
        $book_ids = Book::inRandomOrder()->pluck('id')->toArray();

        return [
            'wishlist_id' => $this->faker->randomElement($wishlist_ids),
            'book_id' => $this->faker->randomElement($book_ids),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
