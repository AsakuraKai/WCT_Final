<?php

use Illuminate\Support\Facades\Route;

// Simple test route that doesn't require database
Route::get('/test', function () {
    return view('simple-test');
});
