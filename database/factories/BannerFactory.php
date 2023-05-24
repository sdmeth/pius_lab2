<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
            'active_from' => now(),
            'active_until' => null,
            'redirect_link' => fake()->url,
            'local_path' => "storage/images/banners/" . basename(fake()->image(storage_path("app/public/images/banners")))
        ];
    }
}
