@extends('layouts.app')

@section('title', $game->title . ' - Game Intel')

@section('content')
<!-- Game Hero Section -->
<div class="game-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="game-cover">
                    @if($game->image_url)
                        <img src="{{ $game->image_url }}" alt="{{ $game->title }}" class="game-cover-image">
                    @else
                        <div class="game-cover-placeholder">
                            <i class="bi bi-controller"></i>
                        </div>
                    @endif
                    <div class="game-cover-overlay">
                        @if($game->is_from_steam && $game->steam_app_id)
                            <a href="https://store.steampowered.com/app/{{ $game->steam_app_id }}" 
                               target="_blank" class="btn btn-neon btn-sm">
                                <i class="bi bi-steam"></i> Steam Store
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="game-hero-content">
                    <h1 class="game-hero-title font-gaming">{{ $game->title }}</h1>
                    
                    <!-- Gaming Stats Bar -->
                    <div class="game-stats-bar">
                        @if($game->price !== null)
                            <div class="stat-badge">
                                @if($game->price == 0)
                                    <span class="price-free">FREE</span>
                                @else
                                    <span class="price-tag">${{ number_format($game->price, 2) }}</span>
                                @endif
                            </div>
                        @endif
                        
                        @if($game->rating)
                            <div class="stat-badge">
                                <div class="rating-display">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $game->rating)
                                            <i class="bi bi-star-fill text-neon-orange"></i>
                                        @else
                                            <i class="bi bi-star text-muted"></i>
                                        @endif
                                    @endfor
                                    <span class="rating-value">{{ $game->rating }}</span>
                                </div>
                            </div>
                        @endif
                        
                        @if($game->is_from_steam)
                            <div class="stat-badge steam-badge">
                                <i class="bi bi-steam"></i> Steam Verified
                            </div>
                        @endif
                    </div>

                    <!-- Game Intel Grid -->
                    <div class="game-intel-grid">                        @if($game->publisher)
                            <div class="intel-item">
                                <div class="intel-label">Publisher</div>
                                <div class="intel-value">
                                    <a href="{{ route('games.index', ['publisher' => $game->publisher->id]) }}" class="publisher-link">
                                        {{ $game->publisher->name }}
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        @if($game->developers->count() > 0)
                            <div class="intel-item">
                                <div class="intel-label">Developer{{ $game->developers->count() > 1 ? 's' : '' }}</div>
                                <div class="intel-value">{{ $game->developers->pluck('name')->join(', ') }}</div>
                            </div>
                        @endif
                        
                        @if($game->release_date)
                            <div class="intel-item">
                                <div class="intel-label">Launch Date</div>
                                <div class="intel-value">{{ \Carbon\Carbon::parse($game->release_date)->format('M d, Y') }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- Gaming Tags -->                    @if($game->genres->count() > 0)
                        <div class="game-tags-section">
                            <div class="tags-label">Game Modes</div>
                            <div class="game-tags">
                                @foreach($game->genres as $genre)
                                    <a href="{{ route('games.index', ['genre' => $genre->id]) }}" class="tag-neon clickable-tag">{{ $genre->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif                    <!-- Platform Support -->
                    @if($game->platforms->count() > 0)
                        <div class="platform-support">
                            <div class="platform-label">Compatible Systems</div>
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
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Main Game Intel -->
        <div class="col-lg-8">
            <!-- Game Description -->
            @if($game->description)
                <div class="card-glass mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-file-text text-neon-cyan me-2 fs-4"></i>
                            <h5 class="font-gaming mb-0">Mission Briefing</h5>
                        </div>
                        <div class="game-description-content">                            {!! nl2br(e($game->description)) !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Reviews Command Center -->
            <div class="card-glass mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-chat-square-text text-neon-purple me-2 fs-4"></i>
                        <h5 class="font-gaming mb-0">Player Reviews</h5>
                        <span class="badge badge-neon ms-auto">{{ $game->reviews->count() }}</span>
                    </div>
                    
                    @if($game->reviews->count() > 0)
                        <div class="reviews-container">
                            @foreach($game->reviews as $review)
                                <div class="review-card">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <h6 class="reviewer-name">{{ $review->user->name }}</h6>
                                            <div class="review-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="bi bi-star-fill text-neon-orange"></i>
                                                    @else
                                                        <i class="bi bi-star text-muted"></i>
                                                    @endif
                                                @endfor
                                                <span class="rating-value">{{ $review->rating }}/5</span>
                                            </div>
                                        </div>
                                        <small class="review-time">{{ $review->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if($review->comment)
                                        <p class="review-comment">{{ $review->comment }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-reviews">
                            <i class="bi bi-chat-square-text-fill text-neon-cyan"></i>
                            <h6 class="font-gaming">No Reviews Logged</h6>
                            <p class="text-muted">Deploy the first tactical review for this game!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Mission Control Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions Command Panel -->
            <div class="card-glass mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-lightning text-neon-orange me-2 fs-4"></i>
                        <h6 class="font-gaming mb-0">Quick Actions</h6>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('games.index') }}" class="btn btn-outline-neon w-100 mb-2">
                            <i class="bi bi-arrow-left"></i> Back to Arsenal
                        </a>                        @if($game->steam_app_id)
                            <a href="https://store.steampowered.com/app/{{ $game->steam_app_id }}" 
                               target="_blank" class="btn btn-neon w-100 mb-2">
                                <i class="bi bi-steam"></i> Launch on Steam
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Gaming Analytics -->
            <div class="card-glass">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-graph-up text-neon-green me-2 fs-4"></i>
                        <h6 class="font-gaming mb-0">Analytics</h6>
                    </div>
                    <div class="analytics-grid">
                        <div class="analytics-item">
                            <div class="analytics-label">Total Reviews</div>
                            <div class="analytics-value">{{ $game->reviews->count() }}</div>
                        </div>
                        @if($game->reviews->count() > 0)
                            <div class="analytics-item">
                                <div class="analytics-label">Avg Rating</div>
                                <div class="analytics-value">{{ number_format($game->reviews->avg('rating'), 1) }}/5</div>
                            </div>
                        @endif
                        <div class="analytics-item">
                            <div class="analytics-label">Deployed</div>
                            <div class="analytics-value">{{ $game->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="analytics-item">
                            <div class="analytics-label">Last Update</div>
                            <div class="analytics-value">{{ $game->updated_at->diffForHumans() }}</div>
                        </div>                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
