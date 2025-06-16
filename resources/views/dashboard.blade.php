@extends('layouts.app')

@section('title', 'Command Center')

@section('content')
<div class="container py-4">
    <!-- Epic Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-hero p-5 rounded fade-in">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="hero-title font-gaming text-neon-cyan glow-text mb-3">
                            <i class="bi bi-speedometer2"></i> COMMAND CENTER
                        </h1>
                        <h2 class="welcome-text mb-2">
                            Welcome back, <span class="text-neon-purple">{{ auth()->user()->name }}</span>!
                        </h2>
                        <p class="hero-subtitle">Your gaming empire awaits. Manage your digital universe from here.</p>
                    </div>
                    <div class="col-lg-4 text-end">
                        <div class="gaming-icon">
                            <i class="bi bi-controller"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gaming Statistics Grid -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card games-card h-100 fade-in-up">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="bi bi-controller text-neon-cyan"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number text-neon-cyan">{{ $stats['total_games'] ?? 0 }}</h3>
                        <p class="stat-label">GAME ARSENAL</p>
                        <div class="stat-action">
                            <a href="{{ route('games.index') }}" class="btn btn-sm btn-outline-gaming">
                                <i class="bi bi-eye"></i> VIEW ALL
                            </a>
                        </div>
                    </div>
                </div>
                <div class="stat-glow cyan-glow"></div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card users-card h-100 fade-in-up">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="bi bi-people text-neon-green"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number text-neon-green">{{ $stats['total_users'] ?? 0 }}</h3>
                        <p class="stat-label">ACTIVE PLAYERS</p>
                        <div class="stat-action">
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-gaming">
                                <i class="bi bi-gear"></i> MANAGE
                            </a>
                        </div>
                    </div>
                </div>
                <div class="stat-glow green-glow"></div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card publishers-card h-100 fade-in-up">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="bi bi-building text-neon-purple"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number text-neon-purple">{{ $stats['total_publishers'] ?? 0 }}</h3>
                        <p class="stat-label">PUBLISHERS</p>
                        <div class="stat-action">
                            <span class="badge bg-purple">ACTIVE</span>
                        </div>
                    </div>
                </div>
                <div class="stat-glow purple-glow"></div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card steam-card h-100 fade-in-up">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="bi bi-steam text-neon-orange"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number text-neon-orange">{{ $stats['steam_games'] ?? 0 }}</h3>
                        <p class="stat-label">STEAM VAULT</p>
                        <div class="stat-action">
                            <a href="{{ route('steam.search') }}" class="btn btn-sm btn-outline-gaming">
                                <i class="bi bi-plus"></i> IMPORT
                            </a>
                        </div>
                    </div>
                </div>
                <div class="stat-glow orange-glow"></div>
            </div>
        </div>
    </div>

    <!-- Mission Control Actions -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="section-title font-gaming text-neon-cyan mb-4">
                <i class="bi bi-lightning"></i> MISSION CONTROL
            </h3>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('games.index') }}" class="action-portal games-portal text-decoration-none">
                        <div class="portal-content">
                            <div class="portal-icon">
                                <i class="bi bi-collection"></i>
                            </div>
                            <h5 class="portal-title">GAMES VAULT</h5>
                            <p class="portal-desc">Browse your digital library</p>
                        </div>
                        <div class="portal-glow"></div>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('users.index') }}" class="action-portal users-portal text-decoration-none">
                        <div class="portal-content">
                            <div class="portal-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <h5 class="portal-title">USER NEXUS</h5>
                            <p class="portal-desc">Manage player accounts</p>
                        </div>
                        <div class="portal-glow"></div>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('steam.search') }}" class="action-portal steam-portal text-decoration-none">
                        <div class="portal-content">
                            <div class="portal-icon">
                                <i class="bi bi-search"></i>
                            </div>
                            <h5 class="portal-title">STEAM SCANNER</h5>
                            <p class="portal-desc">Import from Steam universe</p>
                        </div>
                        <div class="portal-glow"></div>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <a href="/docs" class="action-portal api-portal text-decoration-none">
                        <div class="portal-content">
                            <div class="portal-icon">
                                <i class="bi bi-code-slash"></i>
                            </div>
                            <h5 class="portal-title">API CODEX</h5>
                            <p class="portal-desc">Developer documentation</p>
                        </div>
                        <div class="portal-glow"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Feed -->
    @if(isset($recent_games) && $recent_games->count() > 0)
        <div class="row">
            <div class="col-12">
                <h3 class="section-title font-gaming text-neon-purple mb-4">
                    <i class="bi bi-clock-history"></i> RECENT ACQUISITIONS
                </h3>
                <div class="row g-4">
                    @foreach($recent_games as $game)
                        <div class="col-lg-4 col-md-6">
                            <div class="game-card fade-in-up">
                                <div class="game-image-container">
                                    @if($game->image_url)
                                        <img src="{{ $game->image_url }}" class="game-image" alt="{{ $game->title }}">
                                    @else
                                        <div class="game-placeholder">
                                            <i class="bi bi-controller"></i>
                                        </div>
                                    @endif
                                    <div class="game-overlay">
                                        <a href="{{ route('games.show', $game) }}" class="btn btn-gaming btn-sm">
                                            <i class="bi bi-eye"></i> ANALYZE
                                        </a>
                                    </div>
                                </div>
                                <div class="game-info">
                                    <h6 class="game-title">{{ Str::limit($game->name, 30) }}</h6>
                                    @if($game->publisher)
                                        <p class="game-publisher">
                                            <i class="bi bi-building text-neon-cyan"></i> {{ $game->publisher->name }}
                                        </p>
                                    @endif
                                    @if($game->genres->count() > 0)
                                        <div class="game-genres">
                                            @foreach($game->genres->take(2) as $genre)
                                                <span class="genre-tag">{{ $genre->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="game-meta">
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i> {{ $game->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-controller"></i>
                    </div>
                    <h4 class="empty-title font-gaming text-neon-cyan">NO GAMES IN ARSENAL</h4>
                    <p class="empty-desc">Your gaming vault is empty. Time to start building your empire!</p>
                    <div class="empty-actions">
                        <a href="{{ route('steam.search') }}" class="btn btn-gaming me-3">
                            <i class="bi bi-steam"></i> IMPORT FROM STEAM
                        </a>
                        <a href="{{ route('games.index') }}" class="btn btn-outline-gaming">
                            <i class="bi bi-collection"></i> BROWSE LIBRARY
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Dashboard Hero Section */
.dashboard-hero {
    background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
    border: 2px solid var(--neon-cyan);
    box-shadow: var(--shadow-neon);
    position: relative;
    overflow: hidden;
}

.dashboard-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.1), transparent);
    animation: heroSweep 3s ease-in-out infinite;
}

@keyframes heroSweep {
    0% { left: -100%; }
    50% { left: 100%; }
    100% { left: -100%; }
}

.hero-title {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.welcome-text {
    font-size: 1.5rem;
    color: var(--text-primary);
    font-weight: 600;
}

.hero-subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
}

.gaming-icon {
    font-size: 8rem;
    color: var(--neon-cyan);
    opacity: 0.3;
    animation: iconFloat 3s ease-in-out infinite;
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

/* Enhanced Stat Cards */
.stat-card {
    background: var(--bg-card);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    cursor: pointer;
}

.stat-card:hover {
    transform: translateY(-10px) scale(1.02);
    border-color: var(--neon-cyan);
}

.stat-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.stat-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.stat-number {
    font-family: 'Orbitron', monospace;
    font-size: 2.5rem;
    font-weight: 900;
    margin-bottom: 0.5rem;
    text-shadow: 0 0 20px currentColor;
}

.stat-label {
    font-family: 'Orbitron', monospace;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 2px;
    color: var(--text-secondary);
    margin-bottom: 1rem;
}

.stat-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 20px;
}

.stat-card:hover .stat-glow {
    opacity: 0.1;
}

.cyan-glow { background: radial-gradient(circle, var(--neon-cyan), transparent); }
.green-glow { background: radial-gradient(circle, var(--neon-green), transparent); }
.purple-glow { background: radial-gradient(circle, var(--neon-purple), transparent); }
.orange-glow { background: radial-gradient(circle, var(--neon-orange), transparent); }

/* Action Portals */
.action-portal {
    display: block;
    background: var(--bg-card);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
}

.action-portal:hover {
    transform: translateY(-10px) scale(1.02);
    border-color: var(--neon-cyan);
    text-decoration: none;
}

.portal-content {
    position: relative;
    z-index: 2;
}

.portal-icon {
    font-size: 3.5rem;
    margin-bottom: 1rem;
    color: var(--neon-cyan);
}

.portal-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    letter-spacing: 1px;
}

.portal-desc {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 0;
}

.portal-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle, var(--neon-cyan), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 20px;
}

.action-portal:hover .portal-glow {
    opacity: 0.05;
}

/* Game Cards */
.game-card {
    background: var(--bg-card);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s ease;
    position: relative;
}

.game-card:hover {
    transform: translateY(-5px);
    border-color: var(--neon-purple);
    box-shadow: var(--shadow-card), 0 0 30px rgba(255, 0, 255, 0.2);
}

.game-image-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.game-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.game-placeholder {
    width: 100%;
    height: 100%;
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: var(--text-muted);
}

.game-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.game-card:hover .game-overlay {
    opacity: 1;
}

.game-card:hover .game-image {
    transform: scale(1.1);
}

.game-info {
    padding: 1.5rem;
}

.game-title {
    color: var(--text-primary);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.game-publisher {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.game-genres {
    margin-bottom: 1rem;
}

.genre-tag {
    display: inline-block;
    background: rgba(0, 255, 255, 0.2);
    color: var(--neon-cyan);
    padding: 0.2rem 0.8rem;
    border-radius: 12px;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    margin-bottom: 0.3rem;
    border: 1px solid var(--neon-cyan);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon {
    font-size: 8rem;
    color: var(--neon-cyan);
    opacity: 0.3;
    margin-bottom: 2rem;
}

.empty-title {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.empty-desc {
    color: var(--text-secondary);
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

/* Section Titles */
.section-title {
    font-size: 1.8rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

/* Enhanced Buttons */
.btn-outline-gaming {
    border: 2px solid var(--neon-cyan);
    color: var(--neon-cyan);
    background: transparent;
    border-radius: 15px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-outline-gaming:hover {
    background: var(--neon-cyan);
    color: var(--bg-primary);
    box-shadow: var(--shadow-neon);
}

.bg-purple {
    background: var(--neon-purple) !important;
}

/* Animations */
.fade-in {
    animation: fadeIn 0.8s ease-in;
}

.fade-in-up {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}

.fade-in-up.animate {
    opacity: 1;
    transform: translateY(0);
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .gaming-icon {
        font-size: 4rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>

<script>
// Add scroll animations
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in-up').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection
