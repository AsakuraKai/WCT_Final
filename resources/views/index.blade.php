<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub - Ultimate Gaming API Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
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
            
            /* Text Colors */
            --text-primary: #ffffff;
            --text-secondary: #b8bcc8;
            --text-muted: #6c757d;
            
            /* Gaming Gradients */
            --gradient-neon: linear-gradient(45deg, var(--neon-cyan) 0%, var(--neon-purple) 100%);
            --gradient-gaming: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 25%, #45b7d1 50%, #96ceb4 75%, #feca57 100%);
            
            /* Shadows & Effects */
            --shadow-neon: 0 0 20px rgba(0, 255, 255, 0.3);
            --shadow-purple: 0 0 20px rgba(255, 0, 255, 0.3);
            --shadow-card: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Rajdhani', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            overflow-x: hidden;
            position: relative;
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

        /* Enhanced Navbar */
        .navbar {
            background: rgba(10, 10, 15, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--neon-cyan);
            box-shadow: var(--shadow-neon);
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

        /* Epic Hero Section */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(26, 26, 36, 0.9)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23ffffff" stroke-width="0.5" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-family: 'Orbitron', monospace;
            font-weight: 900;
            font-size: 4.5rem;
            background: var(--gradient-gaming);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(0, 255, 255, 0.5);
            animation: titleGlow 3s ease-in-out infinite alternate;
            margin-bottom: 2rem;
        }

        @keyframes titleGlow {
            from { filter: brightness(1); }
            to { filter: brightness(1.2); }
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            font-weight: 400;
        }

        /* Gaming Buttons */
        .btn-gaming {
            background: var(--gradient-neon);
            border: none;
            border-radius: 25px;
            padding: 15px 40px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: var(--shadow-purple);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-family: 'Orbitron', monospace;
        }

        .btn-gaming::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.4s ease;
        }

        .btn-gaming:hover::before {
            left: 100%;
        }

        .btn-gaming:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-purple), 0 10px 25px rgba(255, 0, 255, 0.4);
        }

        .btn-outline-gaming {
            border: 2px solid var(--neon-cyan);
            color: var(--neon-cyan);
            background: transparent;
            border-radius: 25px;
            padding: 13px 35px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            font-family: 'Orbitron', monospace;
        }

        .btn-outline-gaming:hover {
            background: var(--neon-cyan);
            color: var(--bg-primary);
            box-shadow: var(--shadow-neon);
            transform: translateY(-2px);
        }

        /* Glass Morphism Cards */
        .feature-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: var(--shadow-card);
            transition: all 0.4s ease;
            overflow: hidden;
            position: relative;
            padding: 2rem;
            height: 100%;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-card), var(--shadow-neon);
            border-color: var(--neon-cyan);
        }

        .feature-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            background: var(--gradient-neon);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
            padding: 5rem 0;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 900;
            font-family: 'Orbitron', monospace;
            color: var(--neon-cyan);
            text-shadow: 0 0 20px var(--neon-cyan);
            display: block;
        }

        .stat-label {
            font-size: 1.2rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0.5rem;
        }

        /* API Endpoints Section */
        .api-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .api-card {
            background: var(--bg-card);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 15px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .api-card:hover {
            border-color: var(--neon-cyan);
            box-shadow: var(--shadow-neon);
            transform: translateY(-5px);
        }

        .api-method {
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            padding: 0.3rem 0.8rem;
            border-radius: 8px;
            font-size: 0.8rem;
            margin-right: 1rem;
        }

        .method-get { background: rgba(57, 255, 20, 0.2); color: var(--neon-green); }
        .method-post { background: rgba(255, 102, 0, 0.2); color: var(--neon-orange); }
        .method-put { background: rgba(0, 128, 255, 0.2); color: var(--electric-blue); }
        .method-delete { background: rgba(255, 0, 0, 0.2); color: #ff6666; }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .floating-element:nth-child(2) { top: 60%; right: 15%; animation-delay: 2s; }
        .floating-element:nth-child(3) { bottom: 30%; left: 20%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Dropdown Menus */
        .dropdown-menu {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: var(--shadow-card);
        }

        .dropdown-item {
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(0, 255, 255, 0.1);
            color: var(--neon-cyan);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .navbar-brand {
                font-size: 1.4rem;
            }
        }

        /* Scroll Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in-up.animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* Text Effects */
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

        .text-neon-orange {
            color: var(--neon-orange);
            text-shadow: 0 0 10px var(--neon-orange);
        }

        .glow-text {
            animation: textGlow 2s ease-in-out infinite alternate;
        }        @keyframes textGlow {
            from { text-shadow: 0 0 10px var(--neon-cyan); }
            to { text-shadow: 0 0 20px var(--neon-cyan), 0 0 30px var(--neon-cyan); }
        }

        /* Status Badges */
        .status-badges {
            position: absolute;
            top: 100px;
            right: 30px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .status-badges .badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid;
            backdrop-filter: blur(10px);
            animation: pulse 2s infinite;
        }

        .badge-success {
            background: rgba(57, 255, 20, 0.2);
            color: var(--neon-green);
            border-color: var(--neon-green);
        }

        .badge-warning {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border-color: #ffc107;
        }

        .badge-danger {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border-color: #dc3545;
        }        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Demo Notice */
        .demo-notice {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            background: rgba(13, 202, 240, 0.1);
            border: 1px solid #0dcaf0;
            color: #0dcaf0;
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 15px 25px;
            box-shadow: 0 4px 15px rgba(13, 202, 240, 0.3);
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from { transform: translateX(-50%) translateY(-100%); opacity: 0; }
            to { transform: translateX(-50%) translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Gaming Navigation -->
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
                        <a class="nav-link" href="/games">
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
                    <li class="nav-item">
                        <a class="nav-link" href="#features">
                            <i class="bi bi-lightning"></i> Features
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#api">
                            <i class="bi bi-code-slash"></i> API
                        </a>
                    </li>
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
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle text-neon-cyan"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 text-neon-green"></i> Command Center
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('users.index') }}">
                                    <i class="bi bi-people text-neon-purple"></i> User Management
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right text-neon-orange"></i> Logout
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

    <!-- Epic Hero Section -->
    <section class="hero-section">
        <!-- Floating Gaming Elements -->
        <div class="floating-element">
            <i class="bi bi-controller" style="font-size: 3rem; color: var(--neon-cyan); opacity: 0.3;"></i>
        </div>
        <div class="floating-element">
            <i class="bi bi-joystick" style="font-size: 2.5rem; color: var(--neon-purple); opacity: 0.3;"></i>
        </div>
        <div class="floating-element">
            <i class="bi bi-headset" style="font-size: 2rem; color: var(--neon-green); opacity: 0.3;"></i>
        </div>

        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="hero-content fade-in-up">
                        <h1 class="hero-title">ULTIMATE GAMING API</h1>
                        <p class="hero-subtitle">
                            Power your gaming applications with our comprehensive RESTful API. 
                            Manage games, developers, publishers, and connect with Steam's vast library.
                        </p>
                        
                        <div class="hero-buttons">
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn btn-gaming me-3">
                                    <i class="bi bi-speedometer2 me-2"></i>ENTER COMMAND CENTER
                                </a>
                                <a href="/docs" class="btn btn-outline-gaming">
                                    <i class="bi bi-book me-2"></i>API DOCUMENTATION
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-gaming me-3">
                                    <i class="bi bi-person-plus me-2"></i>START YOUR JOURNEY
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-outline-gaming">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>SIGN IN
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>                <div class="col-lg-6">
                    <div class="text-center">
                        <div style="font-size: 20rem; color: var(--neon-cyan); opacity: 0.1;">
                            <i class="bi bi-controller"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Status Badges -->
        <div class="status-badges">
            <div class="badge badge-success" id="server-status">
                <i class="bi bi-server"></i> Server Online
            </div>
            <div class="badge badge-warning" id="database-status">
                <i class="bi bi-database"></i> Database Checking...
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card fade-in-up">
                        <span class="stat-number" data-count="10000">0</span>
                        <div class="stat-label">Games Available</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card fade-in-up">
                        <span class="stat-number" data-count="500">0</span>
                        <div class="stat-label">Developers</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card fade-in-up">
                        <span class="stat-number" data-count="1000">0</span>
                        <div class="stat-label">Publishers</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card fade-in-up">
                        <span class="stat-number" data-count="50">0</span>
                        <div class="stat-label">API Endpoints</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-gaming" style="font-size: 3rem; color: var(--neon-cyan);">
                    CORE FEATURES
                </h2>
                <p class="lead text-secondary">Powerful tools for modern gaming applications</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-database"></i>
                        </div>
                        <h4 class="text-neon-cyan">Game Database</h4>
                        <p class="text-secondary">
                            Comprehensive game library with detailed metadata, genres, platforms, and reviews.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-steam"></i>
                        </div>
                        <h4 class="text-neon-purple">Steam Integration</h4>
                        <p class="text-secondary">
                            Direct integration with Steam API for real-time game data and popular titles.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h4 class="text-neon-green">Advanced Search</h4>
                        <p class="text-secondary">
                            Powerful search and filtering capabilities across all game data and metadata.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4 class="text-neon-orange">User Management</h4>
                        <p class="text-secondary">
                            Complete user authentication and management system with role-based access.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-star"></i>
                        </div>
                        <h4 class="text-neon-cyan">Reviews & Ratings</h4>
                        <p class="text-secondary">
                            User-generated reviews and rating system for community-driven insights.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <h4 class="text-neon-purple">RESTful API</h4>
                        <p class="text-secondary">
                            Clean, documented REST API with JSON responses and comprehensive endpoints.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- API Endpoints Section -->
    <section id="api" class="py-5" style="background: var(--bg-secondary);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-gaming" style="font-size: 3rem; color: var(--neon-purple);">
                    API ENDPOINTS
                </h2>
                <p class="lead text-secondary">Comprehensive REST API for gaming applications</p>
            </div>
            
            <div class="api-grid">
                <div class="api-card fade-in-up">
                    <div class="d-flex align-items-center mb-3">
                        <span class="api-method method-get">GET</span>
                        <code class="text-neon-cyan">/api/games</code>
                    </div>
                    <p class="text-secondary mb-0">Retrieve all games with pagination and filters</p>
                </div>
                
                <div class="api-card fade-in-up">
                    <div class="d-flex align-items-center mb-3">
                        <span class="api-method method-post">POST</span>
                        <code class="text-neon-orange">/api/games</code>
                    </div>
                    <p class="text-secondary mb-0">Create a new game entry</p>
                </div>
                
                <div class="api-card fade-in-up">
                    <div class="d-flex align-items-center mb-3">
                        <span class="api-method method-get">GET</span>
                        <code class="text-neon-cyan">/api/games/{id}</code>
                    </div>
                    <p class="text-secondary mb-0">Get detailed information about a specific game</p>
                </div>
                
                <div class="api-card fade-in-up">
                    <div class="d-flex align-items-center mb-3">
                        <span class="api-method method-get">GET</span>
                        <code class="text-neon-cyan">/api/steam/search</code>
                    </div>
                    <p class="text-secondary mb-0">Search Steam games by title</p>
                </div>
                
                <div class="api-card fade-in-up">
                    <div class="d-flex align-items-center mb-3">
                        <span class="api-method method-get">GET</span>
                        <code class="text-neon-cyan">/api/genres</code>
                    </div>
                    <p class="text-secondary mb-0">Get all available game genres</p>
                </div>
                
                <div class="api-card fade-in-up">
                    <div class="d-flex align-items-center mb-3">
                        <span class="api-method method-post">POST</span>
                        <code class="text-neon-orange">/api/reviews</code>
                    </div>
                    <p class="text-secondary mb-0">Submit a game review and rating</p>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="/docs" class="btn btn-gaming">
                    <i class="bi bi-book me-2"></i>VIEW FULL DOCUMENTATION
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5">
        <div class="container">
            <div class="text-center">
                <h2 class="font-gaming text-neon-cyan mb-4">READY TO START BUILDING?</h2>
                <p class="lead text-secondary mb-4">
                    Join the gaming revolution and power your applications with our comprehensive API
                </p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-gaming me-3">
                        <i class="bi bi-rocket-takeoff me-2"></i>GET STARTED NOW
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-gaming">
                        <i class="bi bi-box-arrow-in-right me-2"></i>SIGN IN
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-gaming me-3">
                        <i class="bi bi-speedometer2 me-2"></i>GO TO DASHBOARD
                    </a>
                    <a href="/docs" class="btn btn-outline-gaming">
                        <i class="bi bi-book me-2"></i>API DOCS
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Scroll animations
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
        });        // Check database status
        function checkDatabaseStatus() {
            fetch('/api-data')
                .then(response => response.json())
                .then(data => {
                    const dbStatus = document.getElementById('database-status');
                    if (data.status === 'connected') {
                        dbStatus.innerHTML = '<i class="bi bi-database"></i> Database Connected';
                        dbStatus.className = 'badge badge-success';
                        // Hide demo notice if exists
                        const demoNotice = document.getElementById('demo-notice');
                        if (demoNotice) demoNotice.style.display = 'none';
                    } else {
                        dbStatus.innerHTML = '<i class="bi bi-database"></i> Database Disconnected';
                        dbStatus.className = 'badge badge-warning';
                        // Show demo notice
                        showDemoNotice();
                    }
                })
                .catch(error => {
                    const dbStatus = document.getElementById('database-status');
                    dbStatus.innerHTML = '<i class="bi bi-database"></i> Database Error';
                    dbStatus.className = 'badge badge-danger';
                    showDemoNotice();
                });
        }

        function showDemoNotice() {
            let demoNotice = document.getElementById('demo-notice');
            if (!demoNotice) {
                demoNotice = document.createElement('div');
                demoNotice.id = 'demo-notice';
                demoNotice.className = 'alert alert-info demo-notice';
                demoNotice.innerHTML = `
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Demo Mode:</strong> Database is unavailable. Showing demo data for testing purposes.
                `;
                document.body.appendChild(demoNotice);
            }
            demoNotice.style.display = 'block';
        }

        // Check status on page load
        checkDatabaseStatus();
        
        // Check status every 30 seconds
        setInterval(checkDatabaseStatus, 30000);

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Start counter animation when stats section is visible
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('.stat-number').forEach(animateCounter);
                    statsObserver.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
