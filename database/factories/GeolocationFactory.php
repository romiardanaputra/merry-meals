<?php

namespace Database\Factories;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Geolocation>
 */
class GeolocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'userID' => User::factory(),
            'partnerID' => Partner::factory(),
            'ip' => fake()->ipv4(),
            'countryName' => 'Indonesia',
            'countryCode' => 'ID',
            'regionCode' => 'BA',
            'regionName' => 'Bali',
            'cityName' => fake()->city(),
            'zipCode' => fake()->postcode(),
            'latitude' => fake()->latitude(-8.9, -8.3),
            'longitude' => fake()->longitude(114.4, 115.7),
        ];
    }
}
