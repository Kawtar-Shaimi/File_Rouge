<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Wishlist;
use App\Models\WishlistBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book_ids = Book::inRandomOrder()->pluck('id')->toArray();
        $wishlists = Wishlist::all();

        foreach ($wishlists as $wishlist) {
            for ($i = 0; $i < random_int(1, 10); $i++) {
                WishlistBook::create([
                    'wishlist_id' => $wishlist->id,
                    'book_id' => fake()->randomElement($book_ids),
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => fake()->dateTimeBetween('-1 year', 'now')
                ]);
            }
        }
    }
}
