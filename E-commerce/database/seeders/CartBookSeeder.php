<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book_ids = Book::inRandomOrder()->pluck('id')->toArray();

        $carts = Cart::all();

        foreach ($carts as $cart) {
            for ($i = 0; $i < random_int(1, 10); $i++) {
                $cart_book = CartBook::create([
                    'cart_id' => $cart->id,
                    'book_id' => fake()->randomElement($book_ids),
                    'quantity' => fake()->numberBetween(1, 10),
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => fake()->dateTimeBetween('-1 year', 'now')
                ]);
                $cart->increment('total_price', $cart_book->book->price * $cart_book->quantity);
            }
        }
    }
}
