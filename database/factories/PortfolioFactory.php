<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uploadDir = public_path('uploads/portfolio');
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);  // Create directory if it doesn't exist
    }
    $imageName = uniqid('image_') . '.jpg';
    $this->faker->image($uploadDir, 640, 480, null, false); 
        return [
            'user_id' => $this->faker->numberBetween(1,100),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(4),
            'image' =>  $imageName,
            'link'=>$this->faker->url(),
           
        ];
    }
}
