<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

    $uploadDir = public_path('uploads/categories');
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);  // Create directory if it doesn't exist
    }
    $imageName = uniqid('image_') . '.jpg';
    $this->faker->image($uploadDir, 640, 480, null, false); 

        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'is_active' => $this->faker->randomElement([true, false]),
            'image' => $imageName,
        ];
    }
}
