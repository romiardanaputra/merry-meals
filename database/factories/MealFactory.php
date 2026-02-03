<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $mealImages = [
            'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800',
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800',
            'https://images.unsplash.com/photo-1473093226795-af9932fe5856?w=800',
            'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800',
            'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=800',
        ];

        return [
            'partnerID' => Partner::factory(),
            'mealName' => fake()->words(3, true),
            'mealIngredient' => fake()->paragraph(),
            'mealImage' => fake()->randomElement($mealImages),
            'mealDescription' => fake()->sentence(),
            'mealType' => fake()->randomElement(['Lunch', 'Dinner', 'Breakfast']),
            'mealAvailability' => 'Available',
        ];
    }
}
