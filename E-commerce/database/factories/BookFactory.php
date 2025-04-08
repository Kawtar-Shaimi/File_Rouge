<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_ids = Category::inRandomOrder()->pluck('id')->toArray();

        $publisher_ids = User::where('role', 'publisher')
        ->inRandomOrder()
        ->pluck('id')
        ->toArray();

        $imageUrl = 'https://picsum.photos/640/480';
        $imageContents = Http::get($imageUrl)->body();
        $imageName = uniqid("book_") ."_". time() . '.jpg';

        Storage::disk('public')->put("books_images/$imageName", $imageContents);

        $imagePath = "books_images/$imageName";

        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'stock' => $this->faker->randomNumber(3),
            'image' => $imagePath,
            'category_id' => $this->faker->randomElement($category_ids),
            'publisher_id' => $this->faker->randomElement($publisher_ids),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
