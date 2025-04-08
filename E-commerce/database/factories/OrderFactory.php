<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client_ids = User::where('role', 'client')
        ->inRandomOrder()
        ->pluck('id')
        ->toArray();

        return [
            'uuid' => $this->faker->uuid(),
            'order_number' => uniqid('ORDER-'),
            'shipping_address' => $this->faker->streetAddress(),
            'shipping_city' => $this->faker->city(),
            'shipping_postal_code' => $this->faker->postcode(),
            'shipping_country' => $this->faker->country(),
            'shipping_phone' => $this->faker->phoneNumber(),
            'shipping_email' => $this->faker->email(),
            'shipping_name' => $this->faker->name(),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash_on_delivery']),
            'total_amount' => $this->faker->randomFloat(2, 0, 1000),
            'client_id' => $this->faker->randomElement($client_ids),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
