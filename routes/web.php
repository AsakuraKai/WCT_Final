<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebController;

// Welcome route
Route::get('/', function () {
    return view('index');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Routes
Route::get('/games', [WebController::class, 'games'])->name('games.index');
Route::get('/games/{game}', [WebController::class, 'showGame'])->name('games.show');
Route::get('/steam/search', [WebController::class, 'steamSearch'])->name('steam.search');
Route::get('/steam/popular', [WebController::class, 'popularGames'])->name('steam.popular');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [WebController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [WebController::class, 'users'])->name('users.index');
    Route::post('/users', [WebController::class, 'storeUser'])->name('users.store');
    Route::delete('/users/{user}', [WebController::class, 'deleteUser'])->name('users.destroy');
    Route::post('/steam/import', [WebController::class, 'importGame'])->name('steam.import');
});

// API Data endpoint for AJAX
Route::get('/api-data', [WebController::class, 'apiData'])->name('api.data');

// API Documentation route
Route::get('/docs', function () {
    return view('api.documentation');
});