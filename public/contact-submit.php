<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/config/Database.php';

$pdo = Database::connect();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /?contact=error');
    exit;
}

$lang = $_POST['lang'] ?? 'en';
$allowedLangs = ['en', 'fr', 'ar'];
if (!in_array($lang, $allowedLangs, true)) {
    $lang = 'en';
}

$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $message === '') {
    header('Location: /?lang=' . urlencode($lang) . '&contact=error#contact');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: /?lang=' . urlencode($lang) . '&contact=error#contact');
    exit;
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO contact_messages (name, email, message, lang, created_at)
        VALUES (?, ?, ?, ?, NOW())
    ");
    $stmt->execute([$name, $email, $message, $lang]);

    header('Location: /?lang=' . urlencode($lang) . '&contact=success#contact');
    exit;
} catch (Throwable $e) {
    header('Location: /?lang=' . urlencode($lang) . '&contact=error#contact');
    exit;
}