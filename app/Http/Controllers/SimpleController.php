<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimpleController extends Controller
{
    public function index()
    {
        return view('simple-index');
    }
    
    public function test()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Application is working!',
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'timestamp' => now()->toISOString()
        ]);
    }
}
