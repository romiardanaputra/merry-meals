<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $responses = ['Excellent', 'Good', 'Average', 'Poor', 'Satisfactory'];

        return [
            'userID' => User::factory()->member(),
            'questionOne' => fake()->randomElement($responses),
            'questionTwo' => fake()->randomElement($responses),
            'questionThree' => fake()->randomElement($responses),
            'questionFour' => fake()->randomElement($responses),
            'questionFive' => fake()->randomElement($responses),
            'questionSix' => fake()->randomElement($responses),
            'questionSeven' => fake()->randomElement($responses),
            'questionEight' => fake()->randomElement($responses),
            'overall' => fake()->randomElement(['Highly Recommended', 'Recommended', 'Not Recommended']),
        ];
    }
}
