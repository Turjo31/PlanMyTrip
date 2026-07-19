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

// About page (public)
Route::get('/about', function () {
    return view('about');
})->name('about');

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

    // Download trip summary as PDF
    Route::get('/trips/{trip}/pdf', [TripController::class, 'downloadPdf'])->name('trips.pdf');

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

use App\Http\Controllers\WeatherController;

// ── Internal JSON API Routes (called by async JavaScript) ──

// Returns live weather data for a given city (geocode → coordinates → weather)
Route::get('/api/weather', [WeatherController::class, 'getWeather'])->name('api.weather');

// Returns tourist attractions for a given city (geocode → coordinates → places)
Route::get('/api/places', [WeatherController::class, 'getPlaces'])->name('api.places');