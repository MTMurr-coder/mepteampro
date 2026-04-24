<?php
declare(strict_types=1);

header('Content-Type: application/json');
header('X-Frame-Options: DENY');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Generate fresh CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$_SESSION['csrf_token_time'] = time();

echo json_encode([
    'token' => $_SESSION['csrf_token'],
    'timestamp' => time()
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit;