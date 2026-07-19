<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Get live weather for a given city.
     * Step 1: Geocode city name to coordinates using Geoapify.
     * Step 2: Fetch weather from OpenWeatherMap using those coordinates.
     * Returns JSON consumed by async JavaScript on the trip details page.
     */
    public function getWeather(Request $request)
    {
        $city = $request->query('city');

        if (!$city) {
            return response()->json(['error' => 'City is required'], 400);
        }

        // Step 1: Get coordinates for the city using Geoapify Geocoding API
        $geoResponse = Http::get('https://api.geoapify.com/v1/geocode/search', [
            'text'   => $city,
            'limit'  => 1,
            'apiKey' => env('GEOAPIFY_API_KEY'),
        ]);

        if ($geoResponse->failed() || empty($geoResponse->json()['features'])) {
            return response()->json(['error' => 'City not found'], 404);
        }

        $coords = $geoResponse->json()['features'][0]['geometry']['coordinates'];
        $lon    = $coords[0];
        $lat    = $coords[1];

        // Step 2: Fetch weather using coordinates from OpenWeatherMap API
        $weatherResponse = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat'   => $lat,
            'lon'   => $lon,
            'appid' => env('OPENWEATHER_API_KEY'),
            'units' => 'metric',
        ]);

        if ($weatherResponse->failed()) {
            return response()->json(['error' => 'Weather data not found'], 404);
        }

        $data = $weatherResponse->json();

        return response()->json([
            'temp'       => round($data['main']['temp']),
            'feels_like' => round($data['main']['feels_like']),
            'desc'       => ucfirst($data['weather'][0]['description']),
            'humidity'   => $data['main']['humidity'],
            'icon'       => $data['weather'][0]['main'],
        ]);
    }

    /**
     * Get nearby tourist attractions for a given city.
     * Step 1: Geocode city name to coordinates using Geoapify Geocoding API.
     * Step 2: Fetch tourist attractions near those coordinates using Geoapify Places API.
     * Returns JSON consumed by async JavaScript on the trip details page.
     */
    public function getPlaces(Request $request)
    {
        $city = $request->query('city');

        if (!$city) {
            return response()->json(['error' => 'City is required'], 400);
        }

        // Step 1: Get coordinates for the city using Geoapify Geocoding API
        $geoResponse = Http::get('https://api.geoapify.com/v1/geocode/search', [
            'text'   => $city,
            'limit'  => 1,
            'apiKey' => env('GEOAPIFY_API_KEY'),
        ]);

        if ($geoResponse->failed() || empty($geoResponse->json()['features'])) {
            return response()->json(['error' => 'City not found'], 404);
        }

        $coords = $geoResponse->json()['features'][0]['geometry']['coordinates'];
        $lon    = $coords[0];
        $lat    = $coords[1];

        // Step 2: Fetch tourist attractions near those coordinates using Geoapify Places API
        // Using a 10km radius to catch attractions in smaller cities
        $placesResponse = Http::get('https://api.geoapify.com/v2/places', [
            'categories' => 'tourism.attraction,tourism.sights,tourism.attraction.artwork,natural',
            'filter'     => "circle:{$lon},{$lat},10000",
            'limit'      => 6,
            'apiKey'     => env('GEOAPIFY_API_KEY'),
        ]);

        if ($placesResponse->failed()) {
            return response()->json(['error' => 'Places not found'], 404);
        }

        // Extract only the name, category and address from each place
        $places = collect($placesResponse->json()['features'])
            ->map(function ($place) {
                $props    = $place['properties'];
                $category = explode('.', $props['categories'][0] ?? 'tourism');
                return [
                    'name'     => $props['name'] ?? 'Unknown place',
                    'category' => ucfirst(end($category)),
                    'address'  => $props['address_line2'] ?? '',
                ];
            })
            ->filter(fn($p) => $p['name'] !== 'Unknown place')
            ->values();

        return response()->json($places);
    }
}