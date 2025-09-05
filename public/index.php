<?php 
// Temporary: Clear bypass cookie (remove this after testing)
if (isset($_GET['clear_bypass'])) {
    setcookie('site_bypass_' . md5(__DIR__), '', time() - 3600, '/');
    header('Location: /');
    exit;
}


// Site offline configuration
define('OFFLINE_MODE', false); // Set to false to bring site online
define('OFFLINE_PASSWORD', 'brussels2025_'); // Change this password
define('BYPASS_COOKIE', 'site_bypass_' . md5(__DIR__)); // Unique bypass cookie name

// Check if site is offline
if (OFFLINE_MODE) {
    // Check if user has bypass cookie
    if (!isset($_COOKIE[BYPASS_COOKIE])) {
        // Handle password submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
            if ($_POST['password'] === OFFLINE_PASSWORD) {
                // Set bypass cookie for 24 hours
                setcookie(BYPASS_COOKIE, '1', time() + 86400, '/');
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;
            } else {
                $error_message = 'Invalid password';
            }
        }
        
        // Show offline page with password form
        showOfflinePage($error_message ?? '');
        exit;
    }
}

$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Handle homepage
if (empty($request)) {
    include 'home.php';
    exit;
}

// If we reach here, it's a 404
http_response_code(404);
include '404.php'; // Make sure to create this file
exit;

function showOfflinePage($error = '') {
    http_response_code(503);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Site Offline - Maintenance</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                margin: 0;
                padding: 0;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container {
                background: white;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                text-align: center;
                max-width: 400px;
                width: 90%;
            }
            h1 {
                color: #333;
                margin-bottom: 1rem;
            }
            p {
                color: #666;
                margin-bottom: 2rem;
            }
            .password-form {
                margin-top: 2rem;
                padding-top: 2rem;
                border-top: 1px solid #eee;
            }
            input[type="password"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                margin-bottom: 1rem;
                box-sizing: border-box;
            }
            button {
                background: #667eea;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                width: 100%;
            }
            button:hover {
                background: #5a6fd8;
            }
            .error {
                color: red;
                margin-bottom: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>🔧 Site Under Maintenance</h1>
            <p>We're currently performing scheduled maintenance. Please check back soon!</p>
            
            <div class="password-form">
                <form method="POST">
                    <?php if ($error): ?>
                        <div class="error"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <input type="password" name="password" placeholder="Admin Password" required>
                    <button type="submit">Access Site</button>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>