<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'donatorName' => fake()->name(),
            'donationAmount' => fake()->numberBetween(10, 1000) * 1000,
            'donatorEmail' => fake()->safeEmail(),
            'donatorPhone' => fake()->phoneNumber(),
            'description' => fake()->sentence(),
        ];
    }
}
