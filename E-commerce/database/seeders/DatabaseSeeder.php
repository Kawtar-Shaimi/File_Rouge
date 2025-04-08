<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
            CartSeeder::class,
            CartBookSeeder::class,
            OrderSeeder::class,
            OrderBookSeeder::class,
            PaymentSeeder::class,
            WishlistSeeder::class,
            WishlistBookSeeder::class,
            ReviewSeeder::class,
            VisitSeeder::class,
        ]);
    }
}
