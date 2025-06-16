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

class WebController extends Controller
{
    private $steamService;

    public function __construct(SteamApiService $steamService = null)
    {
        $this->steamService = $steamService;
    }

    /**
     * Show the main dashboard
     */
    public function dashboard()
    {
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

        return view('dashboard', compact('stats', 'recent_games'));
    }

    /**
     * Show games page with search functionality
     */
    public function games(Request $request)
    {
        $query = Game::with(['publisher', 'developers', 'genres', 'platforms']);        // Search functionality
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

        $games = $query->paginate(12);
        $genres = Genre::all();
        $platforms = Platform::all();

        return view('games.index', compact('games', 'genres', 'platforms'));
    }

    /**
     * Show single game
     */
    public function showGame(Game $game)
    {
        $game->load(['publisher', 'developers', 'genres', 'platforms', 'reviews.user']);
        return view('games.show', compact('game'));
    }

    /**
     * Show users management page
     */
    public function users(Request $request)
    {
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

        return view('users.index', compact('users'));
    }

    /**
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
            return back()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    /**
     * Delete a user
     */
    public function deleteUser(User $user)
    {
        try {
            // Prevent deleting the current authenticated user
            if ($user->id === auth()->id()) {
                return back()->with('error', 'You cannot delete your own account from here.');
            }

            $user->delete();
            return back()->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }    /**
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
    }

    /**
     * Popular games from Steam
     */
    public function popularGames()
    {
        $popular_games = [];
        if ($this->steamService) {
            $popular_games = $this->steamService->getPopularGames(20);
        }
        return view('steam.popular', compact('popular_games'));
    }    /**
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
    }

    /**
     * API endpoints data for frontend
     */
    public function apiData()
    {
        return response()->json([
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
    }
}
