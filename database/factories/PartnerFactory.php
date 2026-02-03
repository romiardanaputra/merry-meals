<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $restaurantImages = [
            'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800',
            'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=800',
            'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800',
            'https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=800',
            'https://images.unsplash.com/photo-1550966842-28c2e276855b?w=800',
        ];

        return [
            'userID' => User::factory()->partner(),
            'ownerName' => fake()->name(),
            'restaurantName' => fake()->company() . ' Kitchen',
            'restaurantAddress' => fake()->address(),
            'restaurantContact' => fake()->phoneNumber(),
            'restaurantImage' => fake()->randomElement($restaurantImages),
            'foodType' => fake()->randomElement(['Healthy', 'Vegetarian', 'Non-Vegetarian', 'Diabetic-Friendly']),
        ];
    }
}
