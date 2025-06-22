<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming API - Simple Mode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --bg-primary: #0a0a0f;
            --bg-secondary: #1a1a2e;
            --neon-cyan: #00ffff;
            --neon-purple: #ff00ff;
            --text-primary: #ffffff;
        }
        
        body {
            background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
            color: var(--text-primary);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .hero-section {
            text-align: center;
            padding: 100px 0;
        }
        
        .glow-text {
            text-shadow: 0 0 20px var(--neon-cyan);
        }
        
        .card-glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
        }
        
        .btn-neon {
            background: linear-gradient(45deg, var(--neon-cyan), var(--neon-purple));
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-neon:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 255, 255, 0.4);
            color: white;
        }
        
        .status-badge {
            background: rgba(0, 255, 0, 0.2);
            border: 1px solid #00ff00;
            color: #00ff00;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            margin: 20px 0;
        }
        
        .warning-badge {
            background: rgba(255, 165, 0, 0.2);
            border: 1px solid #ffa500;
            color: #ffa500;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero-section">
            <h1 class="display-1 glow-text mb-4">
                <i class="bi bi-controller"></i> Gaming API
            </h1>
            <div class="status-badge">
                <i class="bi bi-check-circle"></i> Server Status: Online
            </div>
            <div class="warning-badge">
                <i class="bi bi-exclamation-triangle"></i> Database: Disconnected
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-glass p-5 mb-4">
                    <h3 class="text-center mb-4">🎮 System Status</h3>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h5>PHP Version</h5>
                            <p class="text-info">{{ phpversion() }}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>Laravel</h5>
                            <p class="text-info">{{ app()->version() }}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>Environment</h5>
                            <p class="text-info">{{ app()->environment() }}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>Time</h5>
                            <p class="text-info">{{ now()->format('H:i:s') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-glass p-5 mb-4">
                    <h4 class="text-center mb-4">🔧 Database Setup Required</h4>
                    <p class="text-center">To access the full Gaming API features, you need to resolve the database connection issue:</p>
                    
                    <div class="mt-4">
                        <h6><i class="bi bi-1-circle"></i> Option 1: Enable MySQL Extensions</h6>
                        <p>Edit your <code>php.ini</code> file and uncomment:</p>
                        <pre class="bg-dark p-3 rounded"><code>extension=pdo_mysql
extension=mysqli</code></pre>
                        
                        <h6 class="mt-4"><i class="bi bi-2-circle"></i> Option 2: Use SQLite</h6>
                        <p>Install SQLite extension or use a different database configuration.</p>
                        
                        <h6 class="mt-4"><i class="bi bi-3-circle"></i> Option 3: Install MySQL/XAMPP</h6>
                        <p>Install a complete web development environment with database support.</p>
                    </div>
                </div>
                
                <div class="text-center">
                    <a href="/test-api" class="btn-neon">
                        <i class="bi bi-code"></i> Test API
                    </a>
                    <a href="https://laravel.com/docs/database" target="_blank" class="btn-neon">
                        <i class="bi bi-book"></i> Laravel Database Docs
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
