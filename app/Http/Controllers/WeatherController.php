<?php

namespace App\Http\Controllers;

use App\Models\WeatherData;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $weatherData = WeatherData::all();
        return response()->json($weatherData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'weather_condition' => 'required|string',
            'location' => 'required|string',
            'recorded_at' => 'required|date',
        ]);

        $weatherData = WeatherData::create($data);

        return response()->json($weatherData, 201);
    }


    /**
     * Display the specified weather data by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(int $id)
    {

        // Return a specific id
        $weatherData = WeatherData::find($id);
        if (!$weatherData) {
            return response()->json(['message' => 'Weather data not found'], 404);
        }
        return response()->json($weatherData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'weather_condition' => 'required|string',
            'location' => 'required|string',
            'recorded_at' => 'required|date',
        ]);

        $weatherData = WeatherData::find($id);
        if (!$weatherData) {
            return response()->json(['message' => 'Weather data not found'], 404);
        }

        $weatherData->update($data);

        return response()->json($weatherData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $weatherData = WeatherData::find($id);
        if (!$weatherData) {
            return response()->json(['message' => 'Weather data not found'], 404);
        }

        $weatherData->delete();

        return response()->json(['message' => 'Weather data deleted successfully']);
    }
        /**
     * Get weather data by location (city or coordinates).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWeatherDataByLocation(Request $request) {
        // Validate the incoming request
        $request->validate([
            'location' => 'required|string',
        ]);

        // Fetch weather data by location
        $location = $request->input('location');
        $weatherData = WeatherData::where('location', $location)->get();

        // Return the weather data as JSON response
        return response()->json($weatherData);
    }
}
