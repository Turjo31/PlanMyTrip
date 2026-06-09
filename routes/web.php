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