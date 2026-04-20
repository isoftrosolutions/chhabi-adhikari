<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function requireAuth(): void {
    if (empty($_SESSION['admin_logged_in'])) {
        header('Location: /admin/login.php');
        exit;
    }
}

function isLoggedIn(): bool {
    return !empty($_SESSION['admin_logged_in']);
}
