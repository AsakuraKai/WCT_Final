<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Gaming API</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Gaming Color Palette */
            --neon-cyan: #00ffff;
            --neon-purple: #ff00ff;
            --neon-green: #39ff14;
            --neon-orange: #ff6600;
            --electric-blue: #0080ff;
            
            /* Dark Theme */
            --bg-primary: #0a0a0f;
            --bg-secondary: #1a1a24;
            --bg-tertiary: #2a2a3a;
            --bg-card: rgba(26, 26, 36, 0.95);
            --bg-glass: rgba(255, 255, 255, 0.05);
            
            /* Text Colors */
            --text-primary: #ffffff;
            --text-secondary: #b8bcc8;
            --text-muted: #6c757d;
            
            /* Gaming Gradients */
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-neon: linear-gradient(45deg, var(--neon-cyan) 0%, var(--neon-purple) 100%);
            --gradient-gaming: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 25%, #45b7d1 50%, #96ceb4 75%, #feca57 100%);
            --gradient-dark: linear-gradient(135deg, #1a1a24 0%, #2a2a3a 100%);
            
            /* Shadows & Effects */
            --shadow-neon: 0 0 20px rgba(0, 255, 255, 0.3);
            --shadow-purple: 0 0 20px rgba(255, 0, 255, 0.3);
            --shadow-card: 0 8px 32px rgba(0, 0, 0, 0.3);
            --shadow-glass: 0 8px 32px rgba(31, 38, 135, 0.37);
        }

        * {
            box-sizing: border-box;
        }        body {
            font-family: 'Rajdhani', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
            padding-top: 80px; /* For fixed navbar */
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, rgba(0, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 0, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 60% 40%, rgba(57, 255, 20, 0.05) 0%, transparent 50%);
            z-index: -1;
            animation: backgroundPulse 10s ease-in-out infinite alternate;
        }

        @keyframes backgroundPulse {
            0% { opacity: 0.3; }
            100% { opacity: 0.6; }
        }

        /* Gaming Typography */
        .font-gaming {
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .font-tech {
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
        }

        /* Enhanced Navbar */
        .navbar {
            background: rgba(10, 10, 15, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--neon-cyan);
            box-shadow: var(--shadow-neon);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-family: 'Orbitron', monospace;
            font-weight: 900;
            font-size: 1.8rem;
            color: var(--neon-cyan) !important;
            text-shadow: 0 0 10px var(--neon-cyan);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            text-shadow: 0 0 20px var(--neon-cyan);
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-neon);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: var(--neon-cyan) !important;
            text-shadow: 0 0 10px var(--neon-cyan);
        }

        .nav-link:hover::before {
            width: 100%;
        }

        /* Glass Morphism Cards */
        .card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: var(--shadow-glass);
            transition: all 0.4s ease;
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .card:hover::before {
            left: 100%;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-card), var(--shadow-neon);
            border-color: var(--neon-cyan);
        }

        /* Gaming Buttons */
        .btn-primary {
            background: var(--gradient-neon);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: var(--shadow-purple);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.4s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-purple), 0 10px 25px rgba(255, 0, 255, 0.4);
        }

        .btn-outline-primary {
            border: 2px solid var(--neon-cyan);
            color: var(--neon-cyan);
            background: transparent;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--neon-cyan);
            color: var(--bg-primary);
            box-shadow: var(--shadow-neon);
            transform: translateY(-2px);
        }

        /* Gaming Forms */
        .form-control, .form-select {
            background: var(--bg-secondary);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            color: var(--text-primary);
            padding: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            background: var(--bg-tertiary);
            border-color: var(--neon-cyan);
            box-shadow: var(--shadow-neon);
            color: var(--text-primary);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        /* Enhanced Alerts */
        .alert {
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border-left: 4px solid;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(57, 255, 20, 0.1);
            color: var(--neon-green);
            border-left-color: var(--neon-green);
            box-shadow: 0 0 20px rgba(57, 255, 20, 0.2);
        }

        .alert-danger {
            background: rgba(255, 102, 102, 0.1);
            color: #ff6666;
            border-left-color: #ff6666;
            box-shadow: 0 0 20px rgba(255, 102, 102, 0.2);
        }

        .alert-warning {
            background: rgba(255, 102, 0, 0.1);
            color: var(--neon-orange);
            border-left-color: var(--neon-orange);
            box-shadow: 0 0 20px rgba(255, 102, 0, 0.2);
        }

        .alert-info {
            background: rgba(0, 128, 255, 0.1);
            color: var(--electric-blue);
            border-left-color: var(--electric-blue);
            box-shadow: 0 0 20px rgba(0, 128, 255, 0.2);
        }

        /* Gaming Tables */
        .table {
            color: var(--text-primary);
            background: transparent;
        }

        .table-dark {
            background: var(--bg-secondary);
            border-radius: 15px;
            overflow: hidden;
        }

        .table-hover tbody tr:hover {
            background: rgba(0, 255, 255, 0.1);
            color: var(--neon-cyan);
        }

        /* Neon Text Effects */
        .text-neon-cyan {
            color: var(--neon-cyan);
            text-shadow: 0 0 10px var(--neon-cyan);
        }

        .text-neon-purple {
            color: var(--neon-purple);
            text-shadow: 0 0 10px var(--neon-purple);
        }

        .text-neon-green {
            color: var(--neon-green);
            text-shadow: 0 0 10px var(--neon-green);
        }

        /* Gaming Badges */
        .badge {
            border-radius: 12px;
            padding: 8px 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .badge.bg-primary {
            background: var(--gradient-neon) !important;
            box-shadow: var(--shadow-purple);
        }

        .badge.bg-success {
            background: linear-gradient(45deg, var(--neon-green), #32cd32) !important;
            box-shadow: 0 0 15px rgba(57, 255, 20, 0.4);
        }

        /* Dropdown Menus */
        .dropdown-menu {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: var(--shadow-glass);
        }

        .dropdown-item {
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(0, 255, 255, 0.1);
            color: var(--neon-cyan);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-neon);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--neon-cyan);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.4rem;
            }
            
            .card {
                margin-bottom: 1rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-in-left {
            animation: slideInLeft 0.6s ease-out;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .glow-text {
            animation: textGlow 2s ease-in-out infinite alternate;
        }        @keyframes textGlow {
            from { text-shadow: 0 0 10px var(--neon-cyan); }
            to { text-shadow: 0 0 20px var(--neon-cyan), 0 0 30px var(--neon-cyan); }
        }

        /* Clickable Tags and Platform Links */
        .clickable-tag {
            text-decoration: none !important;
            color: inherit;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .clickable-tag:hover {
            color: var(--neon-cyan) !important;
            transform: translateY(-2px);
            text-shadow: 0 0 10px var(--neon-cyan);
        }

        .clickable-tag::after {
            content: '🔗';
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.7em;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .clickable-tag:hover::after {
            opacity: 1;
        }

        .platform-link {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0 5px;
        }

        .platform-link:hover {
            color: var(--neon-cyan) !important;
            transform: scale(1.1);
            text-shadow: 0 0 10px var(--neon-cyan);
        }

        .platform-link .platform-icon {
            transition: all 0.3s ease;
        }

        .platform-link:hover .platform-icon {
            color: var(--neon-cyan) !important;
        }

        .platform-link .platform-badge {
            transition: all 0.3s ease;
            padding: 2px 8px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
        }        .platform-link:hover .platform-badge {
            background: var(--neon-cyan);
            color: var(--bg-primary) !important;
        }

        /* Publisher Links */
        .publisher-link {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            position: relative;
        }

        .publisher-link:hover {
            color: var(--neon-purple) !important;
            text-shadow: 0 0 10px var(--neon-purple);
        }

        .publisher-link::after {
            content: '🏢';
            position: absolute;
            top: -2px;
            right: -15px;
            font-size: 0.8em;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .publisher-link:hover::after {
            opacity: 1;
        }
    </style>
    @yield('styles')
</head>
<body>    <!-- Gaming Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand font-gaming glow-text" href="{{ url('/') }}">
                <i class="bi bi-controller"></i> GAME<span class="text-neon-purple">HUB</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('games.index') }}">
                            <i class="bi bi-collection"></i> Games Library
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-steam"></i> Steam Portal
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('steam.search') }}">
                                <i class="bi bi-search text-neon-cyan"></i> Search Games
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('steam.popular') }}">
                                <i class="bi bi-fire text-neon-orange"></i> Trending Now
                            </a></li>
                        </ul>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Command Center
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="bi bi-people"></i> User Management
                            </a>
                        </li>
                    @endauth
                </ul>
                
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-plus"></i> Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container-fluid mt-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('warning'))
            <div class="container mt-3">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6">
                    <h5><i class="bi bi-controller"></i> Gaming API</h5>
                    <p class="text-light">Modern gaming platform with Steam integration. Discover, search, and manage your favorite games.</p>
                </div>
                <div class="col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('games.index') }}" class="text-light text-decoration-none">Browse Games</a></li>
                        <li><a href="{{ route('steam.search') }}" class="text-light text-decoration-none">Search Steam</a></li>
                        <li><a href="{{ route('steam.popular') }}" class="text-light text-decoration-none">Popular Games</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>API Endpoints</h6>
                    <ul class="list-unstyled">
                        <li><a href="/api/games" class="text-light text-decoration-none">Games API</a></li>
                        <li><a href="/api/steam/popular" class="text-light text-decoration-none">Steam API</a></li>
                        <li><a href="/docs" class="text-light text-decoration-none">Documentation</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-light">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2025 Gaming API. Built with Laravel & Steam Integration.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
