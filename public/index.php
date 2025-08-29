<?php 
// filepath: /var/www/brucol.be/public/index.php

// This file now only handles:
// 1. Homepage when no specific route is matched
// 2. 404 errors
// 3. Any dynamic routes not handled by Nginx

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
?>