<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SingleGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample games for testing
        \App\Models\Game::create([
            'title' => 'Portal 2',
            'slug' => 'portal-2',
            'description' => 'A mind-bending puzzle platform game featuring portal technology.',
            'release_date' => '2011-04-18',
            'rating' => 9.5,
            'price' => 19.99,
            'is_active' => true,
        ]);

        \App\Models\Game::create([
            'title' => 'Half-Life 2',
            'slug' => 'half-life-2',
            'description' => 'Revolutionary first-person shooter from Valve Corporation.',
            'release_date' => '2004-11-16',
            'rating' => 9.2,
            'price' => 9.99,
            'is_active' => true,
        ]);

        \App\Models\Game::create([
            'title' => 'The Witcher 3: Wild Hunt',
            'slug' => 'witcher-3-wild-hunt',
            'description' => 'Epic fantasy RPG adventure with Geralt of Rivia.',
            'release_date' => '2015-05-19',
            'rating' => 9.8,
            'price' => 39.99,
            'is_active' => true,
        ]);
    }
}
