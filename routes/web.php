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

// Route untuk mengambil data negara
Route::get('/api/negaras', function () {
    $response = Http::get('http://202.157.176.100:3001/negaras');
    return $response->json();
});

// Route untuk mengambil data pelabuhan berdasarkan ID negara
Route::get('/api/pelabuhans', function () {
    $idNegara = request()->query('filter');
    $response = Http::get('http://202.157.176.100:3001/pelabuhans?' . http_build_query(['filter' => $idNegara]));
    return $response->json();
});

// Route untuk mengambil data barang berdasarkan ID pelabuhan
Route::get('/api/barangs', function () {
    $idPelabuhan = request()->query('filter');
    $response = Http::get('http://202.157.176.100:3001/barangs?' . http_build_query(['filter' => $idPelabuhan]));
    return $response->json();
});


