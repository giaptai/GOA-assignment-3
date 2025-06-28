<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/**********************
* route dashboard
*/
Route::get('/', [StudentController::class, 'chart'])->name('home');
Route::get('/dashboard', [StudentController::class, 'chart'])->name('dashboard');

/**********************
* route scores
*/
Route::get('/scores', function () {return view('pages.scores');})->name('scores');
Route::get('/score', [StudentController::class, 'show'])->name('score.show');

/**********************
* route reports
*/
Route::get('/reports', [StudentController::class, 'top10A'])->name('reports');

/**********************
* route settings
*/
Route::get('/settings', function () {return view('pages.settings');})->name('settings');
