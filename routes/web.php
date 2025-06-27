<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'chart'])->name('home');
Route::get('/dashboard', [StudentController::class, 'chart'])->name('dashboard');

/*
* route score
*/
Route::get('/scores', function () {
    return view('scores');
})->name('scores');
Route::get('/score', [StudentController::class, 'show'])->name('score.check');

/*
* route reports
*/
Route::get('/reports', [StudentController::class, 'top10A'])->name('reports');

/*
* route settings
*/
Route::get('/settings', function () {
    return view('settings');
})->name('settings');
