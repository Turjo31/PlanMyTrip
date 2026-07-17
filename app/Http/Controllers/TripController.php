<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Http\Controllers\ActivityController;
use Barryvdh\DomPDF\Facade\Pdf;
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

        // Fetch country info using Geoapify Geocoding API (PHP side)
        // Weather and tourist places are fetched client-side via async JavaScript
        $countryInfo = null;
        try {
            // Simple currency map for common countries
            $currencyMap = [
                'Bangladesh'    => 'BDT (৳)',
                'India'         => 'INR (₹)',
                'Thailand'      => 'THB (฿)',
                'Malaysia'      => 'MYR (RM)',
                'Singapore'     => 'SGD ($)',
                'Indonesia'     => 'IDR (Rp)',
                'Nepal'         => 'NPR (₨)',
                'Sri Lanka'     => 'LKR (₨)',
                'Myanmar'       => 'MMK (K)',
                'Vietnam'       => 'VND (₫)',
                'Cambodia'      => 'KHR (៛)',
                'Philippines'   => 'PHP (₱)',
                'Japan'         => 'JPY (¥)',
                'China'         => 'CNY (¥)',
                'South Korea'   => 'KRW (₩)',
                'United States' => 'USD ($)',
                'United Kingdom'=> 'GBP (£)',
                'France'        => 'EUR (€)',
                'Germany'       => 'EUR (€)',
                'Australia'     => 'AUD ($)',
                'Canada'        => 'CAD ($)',
                'Pakistan'      => 'PKR (₨)',
                'Saudi Arabia'  => 'SAR (﷼)',
                'UAE'           => 'AED (د.إ)',
                'Turkey'        => 'TRY (₺)',
            ];

            $geoResponse = Http::get('https://api.geoapify.com/v1/geocode/search', [
                'text'   => $trip->destination,
                'limit'  => 1,
                'apiKey' => env('GEOAPIFY_API_KEY'),
            ]);

            if ($geoResponse->ok() && !empty($geoResponse->json()['features'])) {
                $props = $geoResponse->json()['features'][0]['properties'];

                $country = $props['country'] ?? 'N/A';

                // Format timezone as GMT offset (e.g. "Asia/Dhaka" → "GMT+6")
                $timezone = 'N/A';
                if (!empty($props['timezone']['name'])) {
                    try {
                        $tz = new \DateTimeZone($props['timezone']['name']);
                        $offset = $tz->getOffset(new \DateTime('now', $tz));
                        $hours = intdiv($offset, 3600);
                        $minutes = abs(($offset % 3600) / 60);
                        $timezone = 'GMT' . ($hours >= 0 ? '+' : '') . $hours . ($minutes > 0 ? ':' . str_pad($minutes, 2, '0', STR_PAD_LEFT) : '');
                    } catch (\Exception $e) {
                        $timezone = $props['timezone']['name'];
                    }
                }

                $countryInfo = [
                    'country'  => $country,
                    'currency' => $currencyMap[$country] ?? 'N/A',
                    'timezone' => $timezone,
                    'city'     => $props['city'] ?? $props['state'] ?? 'N/A',
                ];
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

    // Generate and download trip summary as PDF
    public function downloadPdf(Trip $trip)
    {
        // Make sure user owns this trip
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $places = $trip->places;
        $totalEstimatedCost = $places->sum('estimated_cost');
        $remaining = $trip->budget - $totalEstimatedCost;
        $budgetPercent = $trip->budget > 0 ? min(100, round(($totalEstimatedCost / $trip->budget) * 100)) : 0;

        // Fetch country info for PDF
        $countryInfo = null;
        try {
            $geoResponse = Http::get('https://api.geoapify.com/v1/geocode/search', [
                'text'   => $trip->destination,
                'limit'  => 1,
                'apiKey' => env('GEOAPIFY_API_KEY'),
            ]);

            if ($geoResponse->ok() && !empty($geoResponse->json()['features'])) {
                $props = $geoResponse->json()['features'][0]['properties'];
                $country = $props['country'] ?? 'N/A';

                $currencyMap = [
                    'Bangladesh' => 'BDT (৳)', 'India' => 'INR (₹)',
                    'Thailand'   => 'THB (฿)', 'Malaysia' => 'MYR (RM)',
                    'Singapore'  => 'SGD ($)', 'Indonesia' => 'IDR (Rp)',
                    'Nepal'      => 'NPR (₨)', 'Sri Lanka' => 'LKR (₨)',
                    'France'     => 'EUR (€)', 'Germany' => 'EUR (€)',
                    'Japan'      => 'JPY (¥)', 'China' => 'CNY (¥)',
                ];

                $timezone = 'N/A';
                if (!empty($props['timezone']['name'])) {
                    try {
                        $tz = new \DateTimeZone($props['timezone']['name']);
                        $offset = $tz->getOffset(new \DateTime('now', $tz));
                        $hours = intdiv($offset, 3600);
                        $minutes = abs(($offset % 3600) / 60);
                        $timezone = 'GMT' . ($hours >= 0 ? '+' : '') . $hours . ($minutes > 0 ? ':' . str_pad($minutes, 2, '0', STR_PAD_LEFT) : '');
                    } catch (\Exception $e) {
                        $timezone = $props['timezone']['name'];
                    }
                }

                $countryInfo = [
                    'country'  => $country,
                    'currency' => $currencyMap[$country] ?? 'N/A',
                    'timezone' => $timezone,
                    'city'     => $props['city'] ?? $props['state'] ?? 'N/A',
                ];
            }
        } catch (\Exception $e) {
            $countryInfo = null;
        }

        // Generate PDF from blade view
        $pdf = Pdf::loadView('trips.pdf', compact(
            'trip',
            'places',
            'totalEstimatedCost',
            'remaining',
            'budgetPercent',
            'countryInfo'
        ));

        // Download with a clean filename
        return $pdf->download(str()->slug($trip->title) . '-trip-summary.pdf');
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

        // Get last login time from session or cookie
        $lastLogin = ActivityController::getLastLogin();

        return view('dashboard', compact(
            'trips',
            'totalTrips',
            'upcomingCount',
            'totalBudget',
            'weatherTrip',
            'weatherTemp',
            'weatherDesc',
            'weatherIcon',
            'lastLogin'
        ));
    }
}