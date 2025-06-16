<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class ClearUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Clear all users except the first one (admin)
        User::where('id', '>', 1)->delete();
        
        // OR to delete ALL users:
        // User::truncate();
        
        $this->command->info('Users cleared successfully!');
    }
}
