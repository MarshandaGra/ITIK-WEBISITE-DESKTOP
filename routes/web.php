<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\SoalController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//UMUM - GUEST

Route::get('/login', [AuthController::class, 'showLogin'])
->name('login');

Route::post('/login', [AuthController::class, 'login'])
->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
->name('logout');


//GURU
Route::get('/guru/dashboard', function () {
    return 'Dashboard Guru';})->middleware('role:guru');


//OPERATOR
Route::get('/operator/dashboard', function () {
    return 'Dashboard Operator';})->middleware('role:operator');


//GURU DAN OPERATOR
Route::middleware(['auth', 'role:guru,operator'])->group(function () {
    Route::resource('materi', MateriController::class);
    Route::resource('kuis', KuisController::class);
    Route::resource('kuis.soal', SoalController::class)
        ->parameters(['kuis' => 'kuis', 'soal' => 'soal']);
});


//SISWA
Route::get('/siswa/dashboard', function () {
    return 'Dashboard Siswa';})->middleware('role:siswa');


