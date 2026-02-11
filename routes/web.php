<?php

use App\Console\Commands\WeatherCheck;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/weather-test', function () {
    $response = Http::get('https://api.open-meteo.com/v1/forecast', [
        'latitude' => 28.61,
        'longitude' => 77.28,
        'current_weather' => true,
    ]);



    return $response->json();
});
