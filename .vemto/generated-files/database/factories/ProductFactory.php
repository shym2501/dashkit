<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2, 0, 9999),
            'discount' => fake()->randomFloat(2, 0, 9999),
            'total' => fake()->randomFloat(2, 0, 9999),
            'link' => fake()->text(255),
            'is_visibled' => fake()->word(),
            'category_id' => \App\Models\Category::factory(),
            'flash_sale_id' => \App\Models\FlashSale::factory(),
        ];
    }
}
