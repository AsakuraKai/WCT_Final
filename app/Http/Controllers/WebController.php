<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Publisher;
use App\Models\Developer;
use App\Models\Genre;
use App\Models\Platform;
use App\Services\SteamApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    private $steamService;

    public function __construct(SteamApiService $steamService = null)
    {
        $this->steamService = $steamService;
    }    /**
     * Show the main dashboard
     */
    public function dashboard()
    {
        try {
            $stats = [
                'total_games' => Game::count(),
                'total_users' => User::count(),
                'total_publishers' => Publisher::count(),
                'total_developers' => Developer::count(),
                'steam_games' => Game::where('is_from_steam', true)->count(),
            ];

            $recent_games = Game::with(['publisher', 'developers', 'genres'])
                               ->orderBy('created_at', 'desc')
                               ->limit(6)
                               ->get();
        } catch (\Exception $e) {
            // Fallback data when database is unavailable
            $stats = [
                'total_games' => 1250,
                'total_users' => 50,
                'total_publishers' => 120,
                'total_developers' => 200,
                'steam_games' => 850,
            ];

            $recent_games = collect([
                (object)[
                    'id' => 1,
                    'title' => 'Cyberpunk 2077',
                    'description' => 'Open-world action-adventure RPG',
                    'release_date' => '2020-12-10',
                    'publisher' => (object)['name' => 'CD Projekt'],
                    'developers' => collect([(object)['name' => 'CD Projekt RED']]),
                    'genres' => collect([(object)['name' => 'RPG']])
                ],
                (object)[
                    'id' => 2,
                    'title' => 'The Witcher 3',
                    'description' => 'Fantasy RPG adventure',
                    'release_date' => '2015-05-19',
                    'publisher' => (object)['name' => 'CD Projekt'],
                    'developers' => collect([(object)['name' => 'CD Projekt RED']]),
                    'genres' => collect([(object)['name' => 'RPG']])
                ]
            ]);
        }

        return view('dashboard', compact('stats', 'recent_games'));
    }    /**
     * Show games page with search functionality
     */
    public function games(Request $request)
    {
        try {
            $query = Game::with(['publisher', 'developers', 'genres', 'platforms']);
            
            // Search functionality
            if ($request->filled('search')) {
                $search = $request->get('search');
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }

            // Filter by genre
            if ($request->filled('genre')) {
                $query->whereHas('genres', function($q) use ($request) {
                    $q->where('genres.id', $request->get('genre'));
                });
            }

            // Filter by platform
            if ($request->filled('platform')) {
                $query->whereHas('platforms', function($q) use ($request) {
                    $q->where('platforms.id', $request->get('platform'));
                });
            }

            // Filter by publisher
            if ($request->filled('publisher')) {
                $query->where('publisher_id', $request->get('publisher'));
            }

            $games = $query->paginate(12);
            $genres = Genre::all();
            $platforms = Platform::all();
            $publishers = Publisher::all();
        } catch (\Exception $e) {
            // Fallback data when database is unavailable
            $games = new \Illuminate\Pagination\LengthAwarePaginator(
                collect([
                    (object)[
                        'id' => 1,
                        'title' => 'Cyberpunk 2077',
                        'description' => 'Open-world action-adventure RPG set in Night City',
                        'release_date' => '2020-12-10',
                        'publisher' => (object)['name' => 'CD Projekt'],
                        'developers' => collect([(object)['name' => 'CD Projekt RED']]),
                        'genres' => collect([(object)['name' => 'RPG']]),
                        'platforms' => collect([(object)['name' => 'PC']])
                    ],
                    (object)[
                        'id' => 2,
                        'title' => 'The Witcher 3: Wild Hunt',
                        'description' => 'Fantasy RPG adventure in a vast open world',
                        'release_date' => '2015-05-19',
                        'publisher' => (object)['name' => 'CD Projekt'],
                        'developers' => collect([(object)['name' => 'CD Projekt RED']]),
                        'genres' => collect([(object)['name' => 'RPG']]),
                        'platforms' => collect([(object)['name' => 'PC']])
                    ],
                    (object)[
                        'id' => 3,
                        'title' => 'Half-Life: Alyx',
                        'description' => 'VR action-adventure game',
                        'release_date' => '2020-03-23',
                        'publisher' => (object)['name' => 'Valve'],
                        'developers' => collect([(object)['name' => 'Valve']]),
                        'genres' => collect([(object)['name' => 'Action']]),
                        'platforms' => collect([(object)['name' => 'PC']])
                    ]
                ]),
                3, // total
                12, // per page
                1, // current page
                ['path' => $request->url(), 'pageName' => 'page']
            );

            $genres = collect([
                (object)['id' => 1, 'name' => 'RPG'],
                (object)['id' => 2, 'name' => 'Action'],
                (object)['id' => 3, 'name' => 'Adventure']
            ]);

            $platforms = collect([
                (object)['id' => 1, 'name' => 'PC'],
                (object)['id' => 2, 'name' => 'PlayStation'],
                (object)['id' => 3, 'name' => 'Xbox']
            ]);

            $publishers = collect([
                (object)['id' => 1, 'name' => 'CD Projekt'],
                (object)['id' => 2, 'name' => 'Valve'],
                (object)['id' => 3, 'name' => 'Activision']
            ]);
        }

        return view('games.index', compact('games', 'genres', 'platforms', 'publishers'));
    }    /**
     * Show single game
     */
    public function showGame($id)
    {
        try {
            $game = Game::with(['publisher', 'developers', 'genres', 'platforms', 'reviews.user'])->findOrFail($id);
        } catch (\Exception $e) {
            // Fallback data when database is unavailable
            $game = (object)[
                'id' => $id,
                'title' => 'Demo Game',
                'description' => 'This is a demo game shown when database is unavailable.',
                'release_date' => '2024-01-01',
                'price' => 59.99,
                'steam_app_id' => null,
                'is_from_steam' => false,
                'publisher' => (object)['name' => 'Demo Publisher'],
                'developers' => collect([(object)['name' => 'Demo Developer']]),
                'genres' => collect([(object)['name' => 'Demo Genre']]),
                'platforms' => collect([(object)['name' => 'PC']]),
                'reviews' => collect([
                    (object)[
                        'id' => 1,
                        'rating' => 5,
                        'comment' => 'Great demo game!',
                        'user' => (object)['name' => 'Demo User'],
                        'created_at' => now()->subDays(1)
                    ]
                ])
            ];
        }
        
        return view('games.show', compact('game'));
    }/**
     * Show users management page
     */
    public function users(Request $request)
    {
        try {
            $query = User::query();

            // Search functionality
            if ($request->filled('search')) {
                $search = $request->get('search');
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }

            $users = $query->orderBy('created_at', 'desc')->paginate(10);
        } catch (\Exception $e) {
            // Fallback data when database is unavailable
            $users = new \Illuminate\Pagination\LengthAwarePaginator(
                collect([
                    (object)[
                        'id' => 1,
                        'name' => 'Demo Admin',
                        'email' => 'admin@example.com',
                        'created_at' => now()->subDays(30),
                        'updated_at' => now()->subDays(1)
                    ],
                    (object)[
                        'id' => 2,
                        'name' => 'Demo User',
                        'email' => 'user@example.com',
                        'created_at' => now()->subDays(15),
                        'updated_at' => now()->subDays(2)
                    ]
                ]),
                2, // total
                10, // per page
                1, // current page
                ['path' => $request->url(), 'pageName' => 'page']
            );
        }

        return view('users.index', compact('users'));
    }    /**
     * Store a new user
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('users.index')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Database unavailable. Cannot create user at this time.');
        }
    }

    /**
     * Delete a user
     */
    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Prevent deleting the current authenticated user
            if (auth()->check() && $user->id === auth()->id()) {
                return back()->with('error', 'You cannot delete your own account from here.');
            }

            $user->delete();
            return back()->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Database unavailable. Cannot delete user at this time.');
        }
    }

    /**
     * Steam search functionality
     */
    public function steamSearch(Request $request)
    {
        $results = [];
        $query = '';

        if ($request->filled('q')) {
            $query = $request->get('q');
            if ($this->steamService) {
                $results = $this->steamService->searchGames($query, 20);
            }
        }

        return view('steam.search', compact('results', 'query'));
    }    /**
     * Popular games from Steam
     */
    public function popularGames()
    {
        $popular_games = [];
        if ($this->steamService) {
            $popular_games = $this->steamService->getPopularGames(20);
        }
        return view('steam.popular', compact('popular_games'));
    }

    /**
     * Import game from Steam
     */
    public function importGame(Request $request)
    {
        $request->validate([
            'steam_app_id' => 'required|integer'
        ]);

        if (!$this->steamService) {
            return back()->with('error', 'Steam service is not available');
        }

        try {
            $steamData = $this->steamService->importGame($request->steam_app_id);
            
            if (!$steamData) {
                return back()->with('error', 'Game not found on Steam');
            }

            // Check if game already exists
            $existingGame = Game::where('steam_app_id', $request->steam_app_id)->first();
            if ($existingGame) {
                return back()->with('warning', 'Game already exists in database');
            }

            $game = Game::create($steamData);

            return back()->with('success', 'Game imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to import game: ' . $e->getMessage());
        }
    }    /**
     * API endpoints data for frontend
     */
    public function apiData()
    {
        try {
            // Test database connection
            DB::connection()->getPdo();
            
            return response()->json([
                'status' => 'connected',
                'stats' => [
                    'total_games' => Game::count(),
                    'total_users' => User::count(),
                    'total_publishers' => Publisher::count(),
                    'total_developers' => Developer::count(),
                ],
                'recent_games' => Game::with(['publisher', 'developers'])
                                     ->orderBy('created_at', 'desc')
                                     ->limit(5)
                                     ->get()
            ]);
        } catch (\Exception $e) {
            // Return mock data when database is not available
            return response()->json([
                'status' => 'disconnected',
                'error' => 'Database unavailable - showing demo data',
                'stats' => [
                    'total_games' => 1250,
                    'total_users' => 50,
                    'total_publishers' => 120,
                    'total_developers' => 200,
                ],
                'recent_games' => [
                    [
                        'id' => 1,
                        'title' => 'Cyberpunk 2077',
                        'description' => 'Open-world action-adventure RPG',
                        'publisher' => ['name' => 'CD Projekt'],
                        'developers' => [['name' => 'CD Projekt RED']]
                    ],
                    [
                        'id' => 2,
                        'title' => 'The Witcher 3',
                        'description' => 'Fantasy RPG adventure',
                        'publisher' => ['name' => 'CD Projekt'],
                        'developers' => [['name' => 'CD Projekt RED']]
                    ],
                    [
                        'id' => 3,
                        'title' => 'Half-Life: Alyx',
                        'description' => 'VR action-adventure game',
                        'publisher' => ['name' => 'Valve'],
                        'developers' => [['name' => 'Valve']]
                    ]
                ]
            ]);
        }
    }
}
