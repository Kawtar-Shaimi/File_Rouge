<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book_ids = Book::inRandomOrder()->pluck('id')->toArray();

        $orders = Order::all();

        foreach ($orders as $order) {
            for ($i = 0; $i < random_int(1, 10); $i++) {
                $book_id = fake()->randomElement($book_ids);
                $quantity = random_int(1, 10);
                $price = Book::find($book_id)->price;
                $order_book = OrderBook::create([
                    'order_id' => $order->id,
                    'book_id' => $book_id,
                    'quantity' => $quantity,
                    'total' => $price * $quantity,
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => fake()->dateTimeBetween('-1 year', 'now')
                ]);
                $order->increment('total_amount', $order_book->total);
            }
        }
    }
}
