<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TripController extends Controller
{
    // Show all trips for the logged in user
    public function index()
    {
        $query = Trip::where('user_id', Auth::id())->latest();

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $trips = $query->get();
        return view('trips.index', compact('trips'));
    }

    // Show create trip form
    public function create()
    {
        return view('trips.create');
    }

    // Store new trip
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'budget'      => 'required|numeric|min:0',
            'status'      => 'required|in:planned,ongoing,completed',
            'notes'       => 'nullable|string',
        ]);

        Trip::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'destination' => $request->destination,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'budget'      => $request->budget,
            'status'      => $request->status,
            'notes'       => $request->notes,
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip created successfully!');
    }

    // Show a single trip with places and API data
    public function show(Trip $trip)
    {
        // Make sure user owns this trip
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $places = $trip->places;
        $totalEstimatedCost = $places->sum('estimated_cost');
        $remaining = $trip->budget - $totalEstimatedCost;
        $budgetPercent = $trip->budget > 0 ? min(100, round(($totalEstimatedCost / $trip->budget) * 100)) : 0;

        // Fetch weather from OpenWeatherMap
        $weather = null;
        try {
            $weatherResponse = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q'     => $trip->destination,
                'appid' => env('OPENWEATHER_API_KEY'),
                'units' => 'metric',
            ]);
            if ($weatherResponse->ok()) {
                $weather = $weatherResponse->json();
            }
        } catch (\Exception $e) {
            $weather = null;
        }

        // Fetch country info from RestCountries
        $countryInfo = null;
        try {
            $countryResponse = Http::get('https://restcountries.com/v3.1/name/' . urlencode($trip->destination));
            if ($countryResponse->ok()) {
                $countryInfo = $countryResponse->json()[0] ?? null;
            }
        } catch (\Exception $e) {
            $countryInfo = null;
        }

        return view('trips.show', compact(
            'trip',
            'places',
            'totalEstimatedCost',
            'remaining',
            'budgetPercent',
            'weather',
            'countryInfo'
        ));
    }

    // Show edit trip form
    public function edit(Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        return view('trips.edit', compact('trip'));
    }

    // Update trip
    public function update(Request $request, Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'budget'      => 'required|numeric|min:0',
            'status'      => 'required|in:planned,ongoing,completed',
            'notes'       => 'nullable|string',
        ]);

        $trip->update($request->all());

        return redirect()->route('trips.show', $trip)->with('success', 'Trip updated successfully!');
    }

    // Delete trip
    public function destroy(Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully!');
    }

    // Dashboard
    public function dashboard()
    {
        $trips = Trip::where('user_id', Auth::id())->latest()->take(5)->get();
        $totalTrips = Trip::where('user_id', Auth::id())->count();
        $upcomingCount = Trip::where('user_id', Auth::id())->where('status', 'planned')->count();
        $totalBudget = Trip::where('user_id', Auth::id())->sum('budget');

        // Weather for nearest upcoming trip
        $weatherTrip = Trip::where('user_id', Auth::id())
            ->where('status', 'planned')
            ->orderBy('start_date')
            ->first();

        $weatherTemp = null;
        $weatherDesc = null;
        $weatherIcon = 'sun';

        if ($weatherTrip) {
            try {
                $weatherResponse = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                    'q'     => $weatherTrip->destination,
                    'appid' => env('OPENWEATHER_API_KEY'),
                    'units' => 'metric',
                ]);
                if ($weatherResponse->ok()) {
                    $data = $weatherResponse->json();
                    $weatherTemp = round($data['main']['temp']);
                    $weatherDesc = $data['weather'][0]['description'];
                    $weatherIcon = str_contains($weatherDesc, 'rain') ? 'cloud-rain' : (str_contains($weatherDesc, 'cloud') ? 'cloud' : 'sun');
                }
            } catch (\Exception $e) {
                // silently fail
            }
        }

        return view('dashboard', compact(
            'trips',
            'totalTrips',
            'upcomingCount',
            'totalBudget',
            'weatherTrip',
            'weatherTemp',
            'weatherDesc',
            'weatherIcon'
        ));
    }
}