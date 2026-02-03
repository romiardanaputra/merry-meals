<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'userID' => User::factory()->member(),
            'partnerID' => Partner::factory(),
            'mealID' => Meal::factory(),
            'volunteerID' => User::factory()->driver(),
            'mealPackage' => fake()->randomElement(['daily', 'weekly', 'monthly']),
            'range' => fake()->numberBetween(1, 15),
            'foodTemperature' => fake()->randomElement(['hot', 'cold']),
            'status' => fake()->randomElement([
                \App\Models\Order::STATUS_PREPARATION,
                \App\Models\Order::STATUS_READY,
                \App\Models\Order::STATUS_ASSIGNED,
                \App\Models\Order::STATUS_PICKED_UP,
                \App\Models\Order::STATUS_IN_TRANSIT,
                \App\Models\Order::STATUS_DELIVERED,
                \App\Models\Order::STATUS_CANCELLED,
            ]),
        ];
    }
}
