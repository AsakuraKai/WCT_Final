<?php

require_once 'vendor/autoload.php';

// Initialize Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle($request = Illuminate\Http\Request::capture());

use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Services\SteamApiService;

echo "Testing function availability...\n";

try {
    echo "1. Testing WebController instantiation... ";
    $webController = new WebController();
    echo "✓ OK\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

try {
    echo "2. Testing AuthController instantiation... ";
    $authController = new AuthController();
    echo "✓ OK\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

try {
    echo "3. Testing GameController instantiation... ";
    $gameController = new GameController();
    echo "✓ OK\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

try {
    echo "4. Testing SteamApiService instantiation... ";
    $steamService = new SteamApiService();
    echo "✓ OK\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

echo "\nAll tests completed.\n";
