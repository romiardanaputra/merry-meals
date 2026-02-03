<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(), // Single line address
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'member',
            'age' => $this->faker->numberBetween(18, 80),
            'remember_token' => Str::random(10),
        ];
    }

    public function superadmin()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'superadmin',
        ]);
    }

    public function admin()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    public function member()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'member',
        ]);
    }

    public function partner()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'partner',
        ]);
    }

    public function driver()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'driver',
        ]);
    }
}
