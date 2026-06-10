<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome', ['announcements' => collect()]);
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalTrips'   => 0,
        'upcomingCount'=> 0,
        'totalBudget'  => 0,
        'trips'        => collect(),
        'weatherTrip'  => null,
        'weatherIcon'  => 'sun',
        'weatherTemp'  => null,
        'weatherDesc'  => null,
    ]);
});

Route::get('/trips/create', function () {
    return view('trips.create');
});

Route::get('/trips/1', function () {
    return view('trips.show');
});