@extends('layouts.app')

@section('title', 'Steam Elite Collection')

@section('content')
<!-- Hero Section -->
<div class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="font-gaming mb-3">
                    <i class="bi bi-steam text-neon-cyan"></i>
                    Steam Elite Collection
                </h1>
                <p class="lead font-tech mb-4">Discover the most popular and trending games dominating the Steam universe. These are the titles commanding the gaming battlefield.</p>
            </div>
            <div class="col-lg-4 text-center">
                <div class="steam-connection-status">
                    <div class="connection-indicator pulse">
                        <i class="bi bi-fire text-neon-orange"></i>
                    </div>
                    <div class="connection-text">Trending Games</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Action Panel -->
    <div class="card-glass mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="bi bi-trophy text-neon-orange me-2 fs-4"></i>
                    <h5 class="font-gaming mb-0">Popular Steam Arsenal</h5>
                </div>
                <a href="{{ route('steam.search') }}" class="btn btn-neon">
                    <i class="bi bi-search"></i> Explore More Games
                </a>
            </div>
        </div>
    </div>

    <!-- Elite Games Grid -->
    @if(isset($popular_games) && count($popular_games) > 0)
        <div class="elite-games-grid">
            @foreach($popular_games as $game)
                <div class="elite-game-card">
                    <div class="elite-game-image-container">
                        @if(isset($game['header_image']))
                            <img src="{{ $game['header_image'] }}" 
                                 class="elite-game-image" 
                                 alt="{{ $game['name'] ?? 'Game Image' }}">
                        @else
                            <div class="elite-game-placeholder">
                                <i class="bi bi-controller"></i>
                            </div>
                        @endif
                        <div class="elite-game-overlay">
                            <div class="popular-badge">
                                <i class="bi bi-fire"></i> TRENDING
                            </div>
                        </div>
                    </div>
                    
                    <div class="elite-game-content">
                        <h5 class="elite-game-title font-tech">{{ $game['name'] ?? 'Unknown Game' }}</h5>
                        
                        @if(isset($game['short_description']))
                            <p class="elite-game-description">
                                {{ Str::limit($game['short_description'], 100) }}
                            </p>
                        @endif

                        <!-- Elite Game Stats -->
                        <div class="elite-game-stats">
                            @if(isset($game['release_date']['date']))
                                <div class="stat-item">
                                    <i class="bi bi-calendar text-neon-green"></i>
                                    <span>{{ $game['release_date']['date'] }}</span>
                                </div>
                            @endif                            @if(isset($game['price_overview']))
                                <div class="stat-item">
                                    @if($game['price_overview']['discount_percent'] > 0)
                                        <span class="discount-badge">
                                            -{{ $game['price_overview']['discount_percent'] }}%
                                        </span>
                                        <span class="price-old">
                                            {{ $game['price_overview']['initial_formatted'] }}
                                        </span>
                                        <span class="price-new">
                                            {{ $game['price_overview']['final_formatted'] }}
                                        </span>
                                    @else
                                        <span class="price-tag">
                                            {{ $game['price_overview']['final_formatted'] }}
                                        </span>
                                    @endif
                                </div>
                            @elseif(isset($game['is_free']) && $game['is_free'])
                                <div class="stat-item">
                                    <span class="price-free">FREE</span>
                                </div>
                            @endif

                            @if(isset($game['genres']) && is_array($game['genres']))
                                <div class="elite-game-genres">
                                    @foreach(array_slice($game['genres'], 0, 3) as $genre)
                                        <span class="tag-neon small">{{ $genre['description'] }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Elite Game Actions -->
                        <div class="elite-game-actions">
                            @if(isset($game['steam_appid']))
                                <a href="https://store.steampowered.com/app/{{ $game['steam_appid'] }}" 
                                   target="_blank" 
                                   class="btn btn-steam flex-fill">
                                    <i class="bi bi-steam"></i> Steam Store
                                </a>
                                
                                @auth
                                    @php
                                        $existsInDb = \App\Models\Game::where('steam_app_id', $game['steam_appid'])->exists();
                                    @endphp
                                    
                                    @if($existsInDb)
                                        <span class="btn btn-success-gaming disabled flex-fill">
                                            <i class="bi bi-check-circle"></i> In Arsenal
                                        </span>
                                    @else
                                        <form method="POST" action="{{ route('steam.import') }}" class="flex-fill">
                                            @csrf
                                            <input type="hidden" name="steam_app_id" value="{{ $game['steam_appid'] }}">
                                            <button type="submit" class="btn btn-neon-outline w-100">
                                                <i class="bi bi-download"></i> Import
                                            </button>                                        </form>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- No Elite Games Found -->
        <div class="card-glass text-center py-5">
            <div class="empty-state">
                <i class="bi bi-exclamation-triangle display-1 text-neon-orange"></i>
                <h5 class="font-gaming mt-3">Steam Network Offline</h5>
                <p class="font-tech text-secondary">Unable to establish connection with Steam servers. Attempting to reload popular games protocol.</p>
                <a href="{{ route('steam.search') }}" class="btn btn-neon mt-3">
                    <i class="bi bi-search"></i> Access Steam Scanner
                </a>
            </div>
        </div>
    @endif

    <!-- Information Panel -->
    <div class="card-glass mt-5">
        <div class="card-body text-center">
            <div class="d-flex align-items-center justify-content-center mb-3">
                <i class="bi bi-info-circle text-neon-cyan me-2 fs-4"></i>
                <h5 class="font-gaming mb-0">Intel Brief</h5>
            </div>
            <p class="font-tech text-secondary mb-0">
                Elite collection sourced from Steam's trending algorithms. Import verified games to expand your local arsenal. 
                Authentication required for import operations.
            </p>
        </div>
    </div>
</div>
@endsection
