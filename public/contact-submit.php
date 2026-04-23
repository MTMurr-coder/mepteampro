<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/config/Database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ── Only accept POST ───────────────────────────────────────────────── */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /?contact=error');
    exit;
}

/* ── Language validation ─────────────────────────────────────────────── */
$lang = $_POST['lang'] ?? 'en';
$allowedLangs = ['en', 'fr', 'ar'];
if (!in_array($lang, $allowedLangs, true)) {
    $lang = 'en';
}

$redirect = static function (string $status) use ($lang): never {
    header('Location: /?lang=' . urlencode($lang) . '&contact=' . $status . '#contact');
    exit;
};

/* ── CSRF verification ───────────────────────────────────────────────── */
$submittedToken = $_POST['csrf_token'] ?? '';
$sessionToken   = $_SESSION['csrf_token'] ?? '';

if (
    $sessionToken === ''
    || !hash_equals($sessionToken, $submittedToken)
) {
    $redirect('error');
}

// Rotate token after use so each submission needs a fresh one
unset($_SESSION['csrf_token']);

/* ── Rate limiting (max 3 submissions per 10 minutes per IP) ─────────── */
$ip          = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateLimitKey = 'contact_rate_' . md5($ip);
$rateData     = $_SESSION[$rateLimitKey] ?? ['count' => 0, 'window_start' => time()];

$windowSeconds = 600; // 10 minutes
$maxSubmissions = 3;

if ((time() - $rateData['window_start']) > $windowSeconds) {
    // Reset window
    $rateData = ['count' => 0, 'window_start' => time()];
}

if ($rateData['count'] >= $maxSubmissions) {
    $redirect('error');
}

/* ── Input validation ────────────────────────────────────────────────── */
$name    = trim((string)($_POST['name']    ?? ''));
$email   = trim((string)($_POST['email']   ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

// Honeypot: a hidden field bots fill but humans leave empty
$honeypot = $_POST['website'] ?? '';
if ($honeypot !== '') {
    // Silently succeed to avoid giving bots feedback
    $redirect('success');
}

if ($name === '' || $email === '' || $message === '') {
    $redirect('error');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $redirect('error');
}

// Length limits
if (mb_strlen($name) > 150) {
    $redirect('error');
}
if (mb_strlen($message) > 5000) {
    $redirect('error');
}

/* ── Persist to DB ───────────────────────────────────────────────────── */
try {
    $pdo = Database::connect();

    $stmt = $pdo->prepare("
        INSERT INTO contact_messages (name, email, message, lang, created_at)
        VALUES (?, ?, ?, ?, NOW())
    ");
    $stmt->execute([$name, $email, $message, $lang]);

    // Increment rate-limit counter only on success
    $rateData['count']++;
    $_SESSION[$rateLimitKey] = $rateData;

    $redirect('success');

} catch (Throwable $e) {
    error_log('[MEPTeam] contact-submit DB error: ' . $e->getMessage());
    $redirect('error');
}