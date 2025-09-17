<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend');
});

Route::get('/api/negaras', function () {
    $response = Http::get('http://202.157.176.100:3001/negaras');
    return $response->json();
});

Route::get('/api/pelabuhans', function () {
    $response = Http::get('http://202.157.176.100:3001/pelabuhans'); 
    return $response->json();
});

Route::get('/api/barangs', function () {
    $response = Http::get('http://202.157.176.100:3001/barangs');
    return $response->json();
});
