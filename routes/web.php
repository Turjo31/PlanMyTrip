<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

// ── Public Routes ──────────────────────────────────────────

// Landing page
Route::get('/', function () {
    $announcements = \App\Models\Announcement::latest()->take(3)->get();
    return view('welcome', compact('announcements'));
})->name('home');

// Community feed (public)
Route::get('/community', [PostController::class, 'index'])->name('community.index');

// Announcements (public)
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');

// ── Guest Only Routes ──────────────────────────────────────

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ── Authenticated Routes ───────────────────────────────────

Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [TripController::class, 'dashboard'])->name('dashboard');

    // Trips
    Route::resource('trips', TripController::class);

    // Places (nested under trips)
    Route::post('/trips/{trip}/places', [PlaceController::class, 'store'])->name('places.store');
    Route::put('/trips/{trip}/places/{place}', [PlaceController::class, 'update'])->name('places.update');
    Route::delete('/trips/{trip}/places/{place}', [PlaceController::class, 'destroy'])->name('places.destroy');

    // Community (create/store/delete — auth required)
    Route::get('/community/create', [PostController::class, 'create'])->name('community.create');
    Route::post('/community', [PostController::class, 'store'])->name('community.store');
    Route::put('/community/{post}', [PostController::class, 'update'])->name('community.update');
    Route::delete('/community/{post}', [PostController::class, 'destroy'])->name('community.destroy');

});

// ── Admin Routes ───────────────────────────────────────────

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Admin dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Manage users
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::patch('/users/{user}/toggle', [AdminController::class, 'toggleUser'])->name('admin.users.toggle');

    // Manage announcements
    Route::get('/announcements', [AdminController::class, 'announcements'])->name('admin.announcements');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('admin.announcements.store');
    Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('admin.announcements.update');
    Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('admin.announcements.destroy');

});

// ── Internal JSON API Routes (called by async JavaScript) ──

// Returns live weather data for a given city
Route::get('/api/weather', function () {
    $city = request('city');

    if (!$city) {
        return response()->json(['error' => 'City is required'], 400);
    }

    $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
        'q'     => $city,
        'appid' => env('OPENWEATHER_API_KEY'),
        'units' => 'metric',
    ]);

    if ($response->failed()) {
        return response()->json(['error' => 'Weather data not found'], 404);
    }

    $data = $response->json();

    return response()->json([
        'temp'      => round($data['main']['temp']),
        'feels_like'=> round($data['main']['feels_like']),
        'desc'      => ucfirst($data['weather'][0]['description']),
        'humidity'  => $data['main']['humidity'],
        'icon'      => $data['weather'][0]['main'],
    ]);
})->name('api.weather');

// Returns tourist attractions for a given city using Geoapify Places API
Route::get('/api/places', function () {
    $city = request('city');

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
    $lon = $coords[0];
    $lat = $coords[1];

    // Step 2: Get tourist attractions near those coordinates using Geoapify Places API
    $placesResponse = Http::get('https://api.geoapify.com/v2/places', [
        'categories' => 'tourism.attraction,tourism.sights',
        'filter'     => "circle:{$lon},{$lat},5000",
        'limit'      => 6,
        'apiKey'     => env('GEOAPIFY_API_KEY'),
    ]);

    if ($placesResponse->failed()) {
        return response()->json(['error' => 'Places not found'], 404);
    }

    // Extract only the name and category from each place
    $places = collect($placesResponse->json()['features'])
        ->map(function ($place) {
            $props = $place['properties'];
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
})->name('api.places');
