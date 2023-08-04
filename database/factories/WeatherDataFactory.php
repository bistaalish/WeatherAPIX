<?php

namespace Database\Factories;

use App\Models\WeatherData;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeatherDataFactory extends Factory
{
    protected $model = WeatherData::class;

    public function definition()
    {
        return [
            'temperature' => $this->faker->randomFloat(2, -10, 40),
            'humidity' => $this->faker->randomFloat(2, 0, 100),
            'wind_speed' => $this->faker->randomFloat(2, 0, 30),
            'weather_condition' => $this->faker->randomElement(['Sunny', 'Cloudy', 'Rainy', 'Windy']),
            'location' => $this->faker->city,
            'recorded_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
