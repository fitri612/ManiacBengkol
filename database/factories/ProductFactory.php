<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $categories = Category::factory(5)->create();
        return [
            //
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->sentence(5),
            'price' => $this->faker->randomFloat(2, 10000, 100000),
            'category_id' => Category::pluck('id')->random(),
            'image' => 'products/' . $this->faker->image('public/storage/products', 640, 480, null, false),
            'stock' => $this->faker->randomNumber(3, false),
            'created_at' =>now(),
            'updated_at' =>now(),
            
        ];
    }
}
