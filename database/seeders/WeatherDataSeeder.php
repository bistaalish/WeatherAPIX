<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeatherData;

class WeatherDataSeeder extends Seeder
{
    public function run()
    {
        WeatherData::factory()->count(10)->create();
    }
}
