<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uploadDir = public_path('uploads/ads');
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);  // Create directory if it doesn't exist
    }
    $imageName = uniqid('image_') . '.jpg';
    $this->faker->image($uploadDir, 640, 480, null, false); 
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'category_id' => $this->faker->numberBetween(1, 10),
            "title" => implode(' ', $this->faker->words(20)), // Join the words into a single string
            "description" => $this->faker->sentence(50),
            'image' => $imageName,
            'phone' => $this->faker->phoneNumber,
            'whatsup' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'website' => $this->faker->url,
            'city' => $this->faker->city,
            'price' => $this->faker->numberBetween(100, 10000),
        ];
    }
}
