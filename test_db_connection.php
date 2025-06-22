<?php

require __DIR__.'/vendor/autoload.php';

use Illuminate\Support\Facades\DB;

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    DB::connection()->getPdo();
    echo "✅ Database connection successful!\n";
    echo "Database: " . config('database.connections.mysql.database') . "\n";
    echo "Host: " . config('database.connections.mysql.host') . "\n";
    echo "Port: " . config('database.connections.mysql.port') . "\n";
} catch (Exception $e) {
    echo "❌ Database connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
}
