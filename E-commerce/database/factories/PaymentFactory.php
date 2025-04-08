<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order_ids = Order::inRandomOrder()->pluck('id')->toArray();
        $order_numbers = Order::inRandomOrder()->pluck('order_number')->toArray();

        return [
            'uuid' => $this->faker->uuid(),
            'method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash_on_delivery']),
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'order_id' => $this->faker->randomElement($order_ids),
            'order_number' => $this->faker->randomElement($order_numbers),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
