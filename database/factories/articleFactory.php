<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\article>
 */
class articleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
                'title' => $this->faker->jobTitle(),
                'slug' => $this->faker->slug(),
                'body' => $this->faker->paragraph(),
                'image' => $this->faker->image('public/images', 640, 480, null, false),
                'author' => $this->faker->name(),
                'created_at' =>now(),
                'updated_at' =>now(),
        ];
    }
}
