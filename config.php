<?php
$docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? '');
$dir = str_replace('\\', '/', __DIR__);
$baseUrl = $docRoot ? str_replace($docRoot, '', $dir) : '';
define('BASE_URL', rtrim($baseUrl, '/'));

define('DB_HOST', 'localhost');
define('DB_NAME', 'ektamultp_dschool');
define('DB_USER', 'ektamultp_d-school');
define('DB_PASS', ';ysIcC3.O$lpKhm2');
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('UPLOAD_URL', BASE_URL . '/uploads/');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER, DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                 PDO::ATTR_EMULATE_PREPARES => false]
            );
        } catch (PDOException $e) {
            die('<div style="font-family:sans-serif;padding:40px;background:#fff0f0;border:1px solid #f00;margin:20px;border-radius:8px"><h2>Database Error</h2><p>' . htmlspecialchars($e->getMessage()) . '</p><p><a href="' . BASE_URL . '/setup.php">Run Setup</a></p></div>');
        }
    }
    return $pdo;
}

function getSetting(string $key, string $default = ''): string {
    static $cache = [];
    if (!isset($cache[$key])) {
        try {
            $stmt = getDB()->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
            $stmt->execute([$key]);
            $cache[$key] = $stmt->fetchColumn() ?: $default;
        } catch (Exception $e) {
            return $default;
        }
    }
    return $cache[$key];
}

function h(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function slugify(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

function extractYouTubeId(string $url): string {
    preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([a-zA-Z0-9_-]{11})/', $url, $m);
    return $m[1] ?? '';
}

function uploadFile(array $file, string $subdir): string {
    $dir = UPLOAD_DIR . $subdir . '/';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','webp'];
    if (!in_array($ext, $allowed)) return '';
    $filename = uniqid() . '.' . $ext;
    if (move_uploaded_file($file['tmp_name'], $dir . $filename)) {
        return UPLOAD_URL . $subdir . '/' . $filename;
    }
    return '';
}
