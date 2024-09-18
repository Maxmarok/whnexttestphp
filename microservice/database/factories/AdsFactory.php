<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ads>
 */
class AdsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'price' => fake()->randomNumber(7, false),
            'photos' => implode(',',[
                fake()->imageUrl(320, 320, 'animals', true),
                fake()->imageUrl(320, 320, 'animals', true),
            ]),
        ];
    }
}
