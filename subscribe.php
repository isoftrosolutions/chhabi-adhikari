<?php
header('Content-Type: application/json');
require_once __DIR__ . '/config.php';

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';

if (!$email) {
    echo json_encode(['success' => false, 'message' => 'Email is required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
    exit;
}

try {
    $pdo = getDb();
    $stmt = $pdo->prepare("INSERT INTO newsletter_subscribers (email, name) VALUES (?, ?) ON DUPLICATE KEY UPDATE name=VALUES(name), is_active=1");
    $stmt->execute([$email, $name]);
    echo json_encode(['success' => true, 'message' => 'Thank you for subscribing!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again.']);
}