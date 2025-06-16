@extends('layouts.app')

@section('title', 'Steam Game Scanner')

@section('content')
<!-- Steam Hero Section -->
<div class="steam-hero mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="font-gaming mb-3">
                    <i class="bi bi-steam text-neon-cyan"></i>
                    Steam Game Scanner
                </h1>
                <p class="lead font-tech mb-4">Connect to the Steam network and scan through millions of games. Deploy high-powered search algorithms to discover your next gaming mission.</p>
            </div>
            <div class="col-lg-4 text-center">
                <div class="steam-connection-status">
                    <div class="connection-indicator">
                        <i class="bi bi-wifi text-neon-green"></i>
                    </div>
                    <div class="connection-text">Steam Network Active</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Steam Search Command Center -->
    <div class="card-glass mb-5">
        <div class="card-body p-4">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-radar text-neon-purple me-3 fs-3"></i>
                <h5 class="font-gaming mb-0">Game Discovery Protocol</h5>
            </div>
            <form method="GET" action="{{ route('steam.search') }}" class="search-form-gaming">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-8 col-md-8">
                        <div class="input-group-gaming">
                            <span class="input-group-text-gaming">
                                <i class="bi bi-search text-neon-cyan"></i>
                            </span>
                            <input type="text" 
                                   name="q" 
                                   class="form-control-gaming" 
                                   placeholder="Enter game title, genre, or keywords..." 
                                   value="{{ $query }}"
                                   autofocus>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <button type="submit" class="btn btn-steam w-100">
                            <i class="bi bi-rocket-takeoff"></i> Launch Scan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>    @if($query)
        <!-- Scan Results Command Panel -->
        <div class="card-glass mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-database text-neon-green me-2"></i>
                        <h5 class="font-gaming mb-0 me-3">Scan Results: "{{ $query }}"</h5>
                        <span class="badge badge-neon">{{ count($results) }} Games Found</span>
                    </div>
                </div>
            </div>
        </div>

        @if(count($results) > 0)
            <div class="steam-games-grid">
                @foreach($results as $game)
                    <div class="steam-game-card">
                        <div class="steam-game-image-container">
                            @if(isset($game['steam_data']['header_image']))
                                <img src="{{ $game['steam_data']['header_image'] }}" 
                                     class="steam-game-image" 
                                     alt="{{ $game['title'] }}">
                            @else
                                <div class="steam-game-placeholder">
                                    <i class="bi bi-controller"></i>
                                </div>
                            @endif
                            <div class="steam-game-overlay">
                                <div class="steam-actions">
                                    @if(isset($game['steam_app_id']))
                                        <a href="https://store.steampowered.com/app/{{ $game['steam_app_id'] }}" 
                                           target="_blank" 
                                           class="btn btn-steam-action">
                                            <i class="bi bi-steam"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="steam-game-content">
                            <h5 class="steam-game-title font-tech">{{ $game['title'] }}</h5>
                            
                            @if(isset($game['description']))
                                <p class="steam-game-description">
                                    {{ Str::limit($game['description'], 120) }}
                                </p>
                            @endif
                            
                            <div class="steam-game-meta">
                                @if(isset($game['price']))
                                    <div class="steam-price">
                                        @if($game['price'] > 0)
                                            <span class="price-tag">${{ number_format($game['price'], 2) }}</span>
                                        @else
                                            <span class="price-free">FREE</span>
                                        @endif
                                    </div>
                                @endif
                                
                                @if(isset($game['release_date']))
                                    <div class="steam-release">
                                        <i class="bi bi-calendar text-neon-orange"></i>
                                        {{ $game['release_date'] }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="steam-game-actions">
                                @if(isset($game['steam_app_id']))
                                    <a href="https://store.steampowered.com/app/{{ $game['steam_app_id'] }}" 
                                       target="_blank" 
                                       class="btn btn-steam w-100 mb-2">
                                        <i class="bi bi-steam"></i> Launch Steam Store
                                    </a>
                                    
                                    @auth
                                        <form action="{{ route('steam.import') }}" method="POST" class="w-100">
                                            @csrf
                                            <input type="hidden" name="steam_app_id" value="{{ $game['steam_app_id'] }}">
                                            <button type="submit" class="btn btn-neon-outline w-100">
                                                <i class="bi bi-download"></i> Import to Arsenal
                                            </button>
                                        </form>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- No Results Found - Gaming Style -->
            <div class="card-glass text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-search display-1 text-neon-cyan"></i>
                    <h5 class="font-gaming mt-3">No Games Detected</h5>
                    <p class="font-tech text-secondary">Steam scan protocol failed to locate matching games. Try recalibrating search parameters.</p>
                    <div class="suggestion-chips mt-4">
                        <span class="chip-suggestion">Portal</span>
                        <span class="chip-suggestion">Witcher</span>
                        <span class="chip-suggestion">Counter-Strike</span>
                        <span class="chip-suggestion">Half-Life</span>
                    </div>
                </div>
            </div>
        @endif
    @else
        <!-- Welcome State -->
        <div class="card-glass text-center py-5">
            <div class="welcome-state">
                <i class="bi bi-steam display-1 text-neon-cyan"></i>
                <h5 class="font-gaming mt-3">Steam Network Ready</h5>
                <p class="font-tech text-secondary">Initialize your game discovery protocol by entering search parameters above.</p>
                <div class="popular-searches mt-4">
                    <div class="search-suggestions">
                        <span class="suggestion-label">Popular Searches:</span>
                        <a href="{{ route('steam.search', ['q' => 'Portal']) }}" class="chip-suggestion-link">Portal</a>
                        <a href="{{ route('steam.search', ['q' => 'Witcher']) }}" class="chip-suggestion-link">Witcher</a>
                        <a href="{{ route('steam.search', ['q' => 'Half-Life']) }}" class="chip-suggestion-link">Half-Life</a>
                        <a href="{{ route('steam.search', ['q' => 'Cyberpunk']) }}" class="chip-suggestion-link">Cyberpunk</a>
                    </div>
                </div>
            </div>
        </div>    @endif
@else
    <!-- Initial State -->
    <div class="row">
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-steam display-1 text-primary"></i>
                <h3 class="mt-3">Search Steam's Game Library</h3>
                <p class="text-muted mb-4">Discover millions of games from Steam's vast collection</p>
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5><i class="bi bi-lightbulb text-warning"></i> Search Tips</h5>
                                <ul class="list-unstyled text-start mt-3">
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> Try game titles like "Portal", "Witcher 3", "Counter-Strike"</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> Search by genre like "RPG", "Action", "Strategy"</li>
                                    <li class="mb-2"><i class="bi bi-check text-success"></i> Look for developers like "Valve", "CD Projekt"</li>
                                    <li class="mb-0"><i class="bi bi-check text-success"></i> Use partial names for broader results</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h5>Quick Search:</h5>
                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                        <a href="{{ route('steam.search', ['q' => 'Portal']) }}" class="btn btn-outline-primary">Portal</a>
                        <a href="{{ route('steam.search', ['q' => 'Witcher']) }}" class="btn btn-outline-primary">Witcher</a>
                        <a href="{{ route('steam.search', ['q' => 'Counter-Strike']) }}" class="btn btn-outline-primary">Counter-Strike</a>
                        <a href="{{ route('steam.search', ['q' => 'Half-Life']) }}" class="btn btn-outline-primary">Half-Life</a>
                        <a href="{{ route('steam.search', ['q' => 'Dota']) }}" class="btn btn-outline-primary">Dota</a>
                        <a href="{{ route('steam.popular') }}" class="btn btn-primary">View Popular Games</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
</div>

<style>
.steam-game-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.steam-game-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.bg-gradient-steam {
    background: linear-gradient(135deg, #1b2838 0%, #2a475e 100%);
}

.card-img-top {
    transition: transform 0.3s ease;
}

.steam-game-card:hover .card-img-top {
    transform: scale(1.02);
}

.quick-search-btn {
    margin: 5px;
    border-radius: 20px;
}
</style>
@endsection
