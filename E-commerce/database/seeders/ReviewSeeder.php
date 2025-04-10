<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client_ids = User::where('role', 'client')->inRandomOrder()->pluck('id')->toArray();
        $books = Book::all();

        foreach ($books as $book) {
            for ($i = 0; $i < rand(1, 10); $i++) {
                Review::create([
                    'uuid' => fake()->uuid(),
                    'content' => fake()->text(),
                    'rate' => fake()->numberBetween(1, 5),
                    'client_id' => fake()->randomElement($client_ids),
                    'book_id' => $book->id,
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => fake()->dateTimeBetween('-1 year', 'now')
                ]);
            }
        }

    }
}
