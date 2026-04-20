<?php
// router.php - Implements Clean URLs and safe URL routing

// Ensure we load configuration first (for BASE_URL and DB)
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
}

// Ensure BASE_URL is defined just in case config doesn't have it
if (!defined('BASE_URL')) {
    $docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? '');
    $dir = str_replace('\\', '/', __DIR__);
    $baseUrl = $docRoot ? str_replace($docRoot, '', $dir) : '';
    define('BASE_URL', rtrim($baseUrl, '/'));
}

// 1. Get the request URI (path only, ignore query string)
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 2. Strip the BASE_URL from the request URI to get the relative route
if (BASE_URL && strpos($requestUri, BASE_URL) === 0) {
    $requestUri = substr($requestUri, strlen(BASE_URL));
}

// Clean up extra slashes from route
$route = trim($requestUri, '/');

// 3. Default route maps to index
if (empty($route)) {
    $route = 'index';
}

// 4. Security: Prevent directory traversal attacks
// Remove malicious sequences like .. and null bytes
$route = str_replace(['..', "\0"], '', $route);

// Normalize route (remove any trailing .php if someone mapped it directly)
if (substr($route, -4) === '.php') {
    $route = substr($route, 0, -4);
}

// 5. Resolve absolute target file path
$targetFile = __DIR__ . '/' . $route . '.php';
$targetDirIndex = __DIR__ . '/' . $route . '/index.php';

// 6. Safe dispatching mechanism
if (file_exists($targetFile)) {
    // Valid route, serve the requested PHP file
    require $targetFile;
} else if (file_exists($targetDirIndex)) {
    // Valid directory index, serve the index file
    require $targetDirIndex;
} else {
    // Basic 404 handler for safe graceful fallback
    http_response_code(404);
    echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>404 Not Found</title>";
    echo "<style>body{font-family:sans-serif;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;background:#f4f6fb;color:#1e293b;}</style>";
    echo "</head><body><div style='text-align:center;'>";
    echo "<h1 style='font-size:3rem;margin-bottom:10px;'>404</h1>";
    echo "<p style='font-size:1.2rem;margin-bottom:20px;'>Oops! The page you're looking for could not be found.</p>";
    echo "<a href='" . htmlspecialchars(BASE_URL) . "/' style='display:inline-block;padding:10px 20px;background:#F5A623;color:#fff;text-decoration:none;border-radius:8px;font-weight:bold;'>Return to Home</a>";
    echo "</div></body></html>";
}
