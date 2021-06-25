<?php

use App\Http\Controllers\CounterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
  Route::get('/counter/up', [CounterController::class, 'up'])->name('counter.up');
  Route::get('/counter/current', [CounterController::class, 'getCurrent'])->name('counter.current');
  Route::get('/counter', [CounterController::class, 'index'])->name('counter');
  Route::get('/laporan', [ReportController::class, 'index'])->name('report');
  Route::get('/', [DashboardController::class, 'index'])->name('home');
});
