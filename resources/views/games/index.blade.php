@extends('layouts.app')

@section('title', 'Games Library')

@section('content')
<!-- Hero Section -->
<div class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="font-gaming mb-3">
                    <i class="bi bi-controller text-neon-cyan"></i>
                    Games Arsenal
                </h1>
                <p class="lead font-tech mb-4">Discover, explore, and manage your ultimate gaming collection. Power up your library with cutting-edge titles!</p>
            </div>
            <div class="col-lg-4 text-center">
                <div class="stat-circle">
                    <div class="stat-number font-gaming">{{ $games->total() }}</div>
                    <div class="stat-label">Total Games</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Command Center - Search and Filter Section -->
    <div class="card-glass mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-cpu text-neon-purple me-2 fs-4"></i>
                <h5 class="font-gaming mb-0">Game Scanner</h5>
            </div>
            <form method="GET" action="{{ route('games.index') }}" class="row g-3">                <div class="col-lg-4 col-md-6">
                    <div class="input-group-neon">
                        <span class="input-group-text">
                            <i class="bi bi-search text-neon-cyan"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               class="form-control-neon" 
                               placeholder="Search games..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <select name="genre" class="form-select-neon" onchange="this.form.submit()">
                        <option value="">🎮 All Genres</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" 
                                    {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <select name="platform" class="form-select-neon" onchange="this.form.submit()">
                        <option value="">💻 All Platforms</option>
                        @foreach($platforms as $platform)
                            <option value="{{ $platform->id }}" 
                                    {{ request('platform') == $platform->id ? 'selected' : '' }}>
                                {{ $platform->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <select name="publisher" class="form-select-neon" onchange="this.form.submit()">
                        <option value="">🏢 All Publishers</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}" 
                                    {{ request('publisher') == $publisher->id ? 'selected' : '' }}>
                                {{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>                </div>
                <div class="col-lg-2 col-md-6">
                    <button type="submit" class="btn btn-neon w-100">
                        <i class="bi bi-funnel"></i> Scan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Command Panel -->
    <div class="card-glass mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <i class="bi bi-database text-neon-green me-2"></i>
                    <h5 class="font-gaming mb-0 me-3">
                        @if(request('search'))
                            Search Results: "{{ request('search') }}"
                        @else
                            Game Database
                        @endif
                    </h5>
                    <span class="badge badge-neon">{{ $games->total() }} Games</span>                </div>
                @if(request()->hasAny(['search', 'genre', 'platform', 'publisher']))
                    <a href="{{ route('games.index') }}" class="btn btn-outline-neon btn-sm">
                        <i class="bi bi-arrow-clockwise"></i> Reset Filters
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Games Arsenal Grid -->
    <div class="row">
        @forelse($games as $game)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="game-card">
                    <div class="game-image-container">
                        @if($game->steam_data && isset($game->steam_data['header_image']))                            <img src="{{ $game->steam_data['header_image'] }}" 
                                 class="game-image" 
                                 alt="{{ $game->title }}">
                        @else
                            <div class="game-placeholder">
                                <i class="bi bi-controller"></i>
                            </div>
                        @endif
                        <div class="game-overlay">
                            <div class="game-actions">
                                <a href="{{ route('games.show', $game->id) }}" class="btn btn-neon btn-sm">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="game-content">
                        <h5 class="game-title font-tech">{{ $game->title }}</h5>                        
                        <div class="game-meta">                            @if($game->publisher)
                                <div class="meta-item">
                                    <i class="bi bi-building text-neon-orange"></i>
                                    <a href="{{ route('games.index', ['publisher' => $game->publisher->id]) }}" class="publisher-link">
                                        {{ $game->publisher->name }}
                                    </a>
                                </div>
                            @endif
                            
                            @if($game->developers->count() > 0)
                                <div class="meta-item">
                                    <i class="bi bi-code-slash text-neon-green"></i>
                                    <span>{{ $game->developers->pluck('name')->implode(', ') }}</span>
                                </div>
                            @endif
                        </div>
                        
                        @if($game->description)
                            <p class="game-description">
                                {{ Str::limit($game->description, 120) }}
                            </p>
                        @endif
                        
                        <!-- Gaming Tags -->                        @if($game->genres->count() > 0)
                            <div class="game-tags mb-3">
                                @foreach($game->genres->take(3) as $genre)
                                    <a href="{{ route('games.index', ['genre' => $genre->id]) }}" class="tag-neon clickable-tag">{{ $genre->name }}</a>
                                @endforeach
                                @if($game->genres->count() > 3)
                                    <span class="tag-more">+{{ $game->genres->count() - 3 }}</span>
                                @endif
                            </div>
                        @endif
                        
                        <!-- Gaming Stats -->
                        <div class="game-stats">
                            <div class="stat-item">
                                @if($game->price > 0)
                                    <span class="price-tag">${{ number_format($game->price, 2) }}</span>
                                @else
                                    <span class="price-free">FREE</span>
                                @endif
                            </div>
                            
                            @if($game->rating > 0)
                                <div class="stat-item">
                                    <div class="rating-display">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $game->rating)
                                                <i class="bi bi-star-fill text-neon-orange"></i>
                                            @else
                                                <i class="bi bi-star text-muted"></i>
                                            @endif
                                        @endfor
                                        <small class="rating-value">{{ $game->rating }}</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                          <!-- Platform Icons -->
                        @if($game->platforms->count() > 0)
                            <div class="platform-icons">
                                @foreach($game->platforms as $platform)
                                    <a href="{{ route('games.index', ['platform' => $platform->id]) }}" class="platform-link" title="Filter by {{ $platform->name }}">
                                        @if($platform->name == 'Windows')
                                            <i class="bi bi-windows platform-icon" title="Windows"></i>
                                        @elseif($platform->name == 'Mac')
                                            <i class="bi bi-apple platform-icon" title="Mac"></i>
                                        @elseif($platform->name == 'Linux')
                                            <i class="bi bi-ubuntu platform-icon" title="Linux"></i>
                                        @else
                                            <span class="platform-badge">{{ $platform->name }}</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="game-actions-footer">
                            <a href="{{ route('games.show', $game->id) }}" class="btn btn-neon-full">
                                <i class="bi bi-rocket"></i> Launch Details
                            </a>                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- No Games Found - Gaming Style -->
            <div class="col-12">
                <div class="card-glass text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-search display-1 text-neon-cyan"></i>
                        <h3 class="font-gaming mt-3">No Games Detected</h3>
                        <p class="font-tech text-secondary">Scanning protocols failed to locate matching games. Recalibrate search parameters.</p>
                        <a href="{{ route('games.index') }}" class="btn btn-neon mt-3">
                            <i class="bi bi-arrow-clockwise"></i> Reset Scanner
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Gaming Pagination -->
    @if($games->hasPages())
        <div class="pagination-container mt-5">
            <div class="card-glass">
                <div class="card-body text-center">
                    <div class="pagination-gaming">
                        {{ $games->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>    @endif
</div>
@endsection
