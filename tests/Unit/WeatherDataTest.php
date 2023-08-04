<?php

namespace Tests\Unit;

use App\Models\WeatherData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\WeatherDataSeeder;
class WeatherDataTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test creating a weather data record.
     *
     * @ return void
     */
    public function testCreatingWeatherData(): void
    {
        // Arrange


        $data = [
            'temperature' => 25.5,
            'humidity' => 65.0,
            'wind_speed' => 10.0,
            'weather_condition' => 'Sunny',
            'location' => 'New York',
            'recorded_at' => now(),
        ];
        $weatherData = WeatherData::create($data);
        $this->assertDatabaseHas('weather_data',[
                    'location' => 'New York'
                ]);
        $this->assertInstanceOf(WeatherData::class, $weatherData);
        $this->assertEquals($data['temperature'], $weatherData->temperature);
        $this->assertEquals($data['humidity'], $weatherData->humidity);
        $this->assertEquals($data['wind_speed'], $weatherData->wind_speed);
        $this->assertEquals($data['weather_condition'], $weatherData->weather_condition);
        $this->assertEquals($data['location'], $weatherData->location);

    }

    public function testDeleteWeatherData(): void{
        // Demo Data
         // Arrange

        $data = [
            'temperature' => 25.5,
            'humidity' => 65.0,
            'wind_speed' => 10.0,
            'weather_condition' => 'Sunny',
            'location' => 'New York',
            'recorded_at' => now(),
        ];
        $location = $data['location'];
        $weatherData = WeatherData::create($data);
        $this->assertDatabaseHas('weather_data',[
                    'location' => $location,
                ]);
        $this->assertInstanceOf(WeatherData::class, $weatherData);
        $this->assertEquals($data['temperature'], $weatherData->temperature);
        $weatherData->delete();
        $this->assertDatabaseMissing('weather_data', [
            'location' => $location,
        ]);

    }
    public function testWeatherDatabaseSeeder(): void {
        $this -> seed(WeatherDataSeeder::class);
        $this->assertDatabaseCount('weather_data', 10);
    }

}
