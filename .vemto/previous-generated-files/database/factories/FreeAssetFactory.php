<?php

namespace Database\Factories;

use App\Models\FreeAsset;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FreeAssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FreeAsset::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(15),
            'link' => fake()->text(),
        ];
    }
}
