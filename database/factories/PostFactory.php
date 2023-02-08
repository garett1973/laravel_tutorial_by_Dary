<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence(),
            'excerpt' => $this->faker->realText($maxNbChars = 15, $indexSize = 2),
            'body' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'is_published' => 1,
            'minutes_to_read' => $this->faker->numberBetween($min = 1, $max = 10),
            'user_id' => 1,
        ];
    }
}
