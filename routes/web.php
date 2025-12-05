<?php

use Illuminate\Support\Facades\Route;

// TOP
Route::get('/', function () {
    return view('top');
});

// Food Menu
Route::get('/menu/food', function () {
    return view('menu.food');
});

// Drink Menu
Route::get('/menu/drink', function () {
    return view('menu.drink');
});

// Seasonal Menu
Route::get('/menu/seasonal', function () {
    return view('menu.seasonal');
});

// access
Route::get('/access', function () {
    return view('access');
});
