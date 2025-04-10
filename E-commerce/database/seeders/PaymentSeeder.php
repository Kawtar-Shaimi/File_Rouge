<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            Payment::create([
                'uuid' => fake()->uuid(),
                'method' => $order->payment_method,
                'amount' => $order->total_amount,
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                'updated_at' => fake()->dateTimeBetween('-1 year', 'now')
            ]);
        }
    }
}
