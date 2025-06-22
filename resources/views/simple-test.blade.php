<!DOCTYPE html>
<html>
<head>
    <title>Simple Test</title>
    <style>
        body { background: #1a1a2e; color: #eee; font-family: Arial; text-align: center; padding: 50px; }
        .container { max-width: 600px; margin: 0 auto; }
        .success { color: #00ff00; font-size: 24px; margin: 20px 0; }
        .info { background: rgba(255,255,255,0.1); padding: 20px; border-radius: 10px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎮 Laravel Server Status</h1>
        <div class="success">✅ Server is Running Successfully!</div>
        
        <div class="info">
            <h3>🔧 System Information</h3>
            <p><strong>PHP Version:</strong> {{ phpversion() }}</p>
            <p><strong>Laravel Version:</strong> {{ app()->version() }}</p>
            <p><strong>Environment:</strong> {{ app()->environment() }}</p>
            <p><strong>Time:</strong> {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
        
        <div class="info">
            <h3>🎯 Next Steps</h3>
            <p>Your Laravel application is working! The database connection issue can be resolved by:</p>
            <ul style="text-align: left;">
                <li>Installing/enabling MySQL PHP extensions (pdo_mysql, mysqli)</li>
                <li>Or setting up a MySQL/SQLite database properly</li>
            </ul>
        </div>
        
        <a href="/" style="color: #00ffff; text-decoration: none; font-size: 18px;">← Back to Main Application</a>
    </div>
</body>
</html>
