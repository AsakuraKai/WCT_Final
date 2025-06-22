<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SteamApiService
{
    private $baseUrl = 'https://store.steampowered.com/api/';
    private $searchUrl = 'https://steamspy.com/api.php';
    
    /**
     * Search for games on Steam
     */
    public function searchGames($query, $limit = 20)
    {
        try {
            // Use SteamSpy API for search as it's more accessible
            $response = Http::timeout(30)->get($this->searchUrl, [
                'request' => 'search',
                'q' => $query,
                'page' => 0
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $this->formatSearchResults($data, $limit);
            }

            return [];
        } catch (\Exception $e) {
            Log::error('Steam search error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get popular games from Steam
     */
    public function getPopularGames($limit = 20)
    {
        try {
            $cacheKey = 'steam_popular_games_' . $limit;
            
            return Cache::remember($cacheKey, 3600, function () use ($limit) {
                // Get top games from SteamSpy
                $response = Http::timeout(30)->get($this->searchUrl, [
                    'request' => 'top100in2weeks'
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    return $this->formatPopularGames($data, $limit);
                }

                return [];
            });
        } catch (\Exception $e) {
            Log::error('Steam popular games error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get game details by Steam App ID
     */
    public function getGameDetails($appId)
    {
        try {
            $cacheKey = 'steam_game_' . $appId;
            
            return Cache::remember($cacheKey, 7200, function () use ($appId) {
                $response = Http::timeout(30)->get($this->baseUrl . 'appdetails', [
                    'appids' => $appId,
                    'cc' => 'US',
                    'l' => 'en'
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (isset($data[$appId]['success']) && $data[$appId]['success']) {
                        return $data[$appId]['data'];
                    }
                }

                return null;
            });
        } catch (\Exception $e) {
            Log::error('Steam game details error for app ' . $appId . ': ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Format search results
     */
    private function formatSearchResults($data, $limit)
    {
        $results = [];
        $count = 0;

        foreach ($data as $appId => $game) {
            if ($count >= $limit) break;
            
            if (is_array($game) && isset($game['name'])) {
                $results[] = [
                    'steam_app_id' => $appId,
                    'title' => $game['name'],
                    'description' => $game['description'] ?? '',
                    'price' => 0, // SteamSpy doesn't provide price
                    'release_date' => date('Y-m-d', strtotime($game['release_date'] ?? 'now')),
                    'steam_data' => [
                        'header_image' => "https://cdn.akamai.steamstatic.com/steam/apps/{$appId}/header.jpg",
                        'screenshot' => "https://cdn.akamai.steamstatic.com/steam/apps/{$appId}/ss_1.jpg"
                    ]
                ];
                $count++;
            }
        }

        return $results;
    }

    /**
     * Format popular games
     */
    private function formatPopularGames($data, $limit)
    {
        $results = [];
        $count = 0;

        foreach ($data as $appId => $game) {
            if ($count >= $limit) break;
            
            if (is_array($game) && isset($game['name'])) {
                $results[] = [
                    'steam_appid' => $appId,
                    'name' => $game['name'],
                    'short_description' => $game['description'] ?? '',
                    'header_image' => "https://cdn.akamai.steamstatic.com/steam/apps/{$appId}/header.jpg",
                    'release_date' => [
                        'date' => date('M d, Y', strtotime($game['release_date'] ?? 'now'))
                    ],
                    'genres' => [
                        ['description' => $game['genre'] ?? 'Action']
                    ],
                    'is_free' => false,
                    'price_overview' => [
                        'final_formatted' => '$19.99',
                        'discount_percent' => 0
                    ]
                ];
                $count++;
            }
        }

        return $results;
    }

    /**
     * Import a game from Steam
     */    public function importGame($appId)
    {
        try {
            $gameData = $this->getGameDetails($appId);
            
            if (!$gameData) {
                return null;
            }
            
            return [
                'title' => $gameData['name'] ?? 'Unknown Game',
                'slug' => $this->createSlug($gameData['name'] ?? 'unknown-game'),
                'description' => $gameData['short_description'] ?? $gameData['detailed_description'] ?? '',
                'steam_app_id' => $appId,
                'is_from_steam' => true,
                'price' => isset($gameData['price_overview']) ? ($gameData['price_overview']['final'] / 100) : 0,
                'release_date' => isset($gameData['release_date']) ? $gameData['release_date']['date'] : null,
                'image_url' => $gameData['header_image'] ?? null,
                'steam_data' => $gameData
            ];
        } catch (\Exception $e) {
            Log::error('Steam import error for app ' . $appId . ': ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create a URL-friendly slug from a title
     */
    private function createSlug($title)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    }
}
