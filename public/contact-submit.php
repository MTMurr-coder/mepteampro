<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/config/Database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ───────────────── SECURITY HEADERS ───────────────── */
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');

/* ───────────────── DB ───────────────── */
$pdo = Database::connect();

/* ───────────────── IP HELPER ───────────────── */
function get_ip(): string {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP']
        ?? $_SERVER['HTTP_X_FORWARDED_FOR']
        ?? $_SERVER['REMOTE_ADDR']
        ?? 'unknown';

    return trim(explode(',', $ip)[0]);
}

/* ───────────────── ERROR LOGGER ───────────────── */
function log_contact_error(PDO $pdo, string $type, string $message = null, array $data = []): void
{
    try {
        $stmt = $pdo->prepare("
            INSERT INTO contact_error_logs
            (ip, error_type, error_message, user_email, user_name, user_message, user_agent)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['ip'] ?? get_ip(),
            $type,
            $message,
            $data['email'] ?? null,
            $data['name'] ?? null,
            $data['message'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
    } catch (Throwable $e) {
        error_log("CONTACT LOG FAILED: " . $e->getMessage());
    }
}

/* ───────────────── REDIRECT WITH STATUS ───────────────── */
function fail(PDO $pdo, string $status, string $message = null): never
{
    $data = [
        'ip' => get_ip(),
        'email' => $_POST['email'] ?? null,
        'name' => $_POST['name'] ?? null,
        'message' => $_POST['message'] ?? null,
    ];

    log_contact_error($pdo, $status, $message ?? "Contact error: $status", $data);

    $lang = $_POST['lang'] ?? 'en';

    header('Location: /?lang=' . urlencode($lang) . '&contact=' . $status . '#contact', true, 302);
    exit;
}

/* ───────────────── ONLY POST ───────────────── */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail($pdo, 'invalid_request', 'Non POST request');
}

/* ───────────────── LANG VALIDATION ───────────────── */
$lang = $_POST['lang'] ?? 'en';
if (!in_array($lang, ['en','fr','ar'], true)) {
    $lang = 'en';
}

/* ───────────────── INPUT SANITIZATION ───────────────── */
$name    = trim((string)($_POST['name'] ?? ''));
$email   = trim((string)($_POST['email'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

// Check for empty fields
if ($name === '' || $email === '' || $message === '') {
    fail($pdo, 'missing_fields');
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    fail($pdo, 'invalid_email');
}

// Validate field lengths
if (mb_strlen($name) < 2 || mb_strlen($name) > 150) {
    fail($pdo, 'invalid_length');
}
if (mb_strlen($message) < 10 || mb_strlen($message) > 5000) {
    fail($pdo, 'invalid_length');
}

/* ───────────────── HONEYPOT ───────────────── */
if (!empty($_POST['website'])) {
    fail($pdo, 'spam_detected', 'Honeypot field filled');
}

/* ───────────────── CSRF TOKEN VALIDATION ───────────────── */
if (
    empty($_SESSION['csrf_token']) ||
    empty($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    fail($pdo, 'csrf_failed', 'CSRF token mismatch or missing');
}

// Optional: check token age (30 minutes)
if (empty($_SESSION['csrf_token_time']) || (time() - $_SESSION['csrf_token_time'] > 1800)) {
    fail($pdo, 'csrf_expired', 'CSRF token expired');
}

/* ───────────────── RATE LIMITING (before reCAPTCHA to save API calls) ───────────────── */
$ip = get_ip();
$window = 600;  // 10 minutes
$limit = 3;     // 3 submissions max

$stmt = $pdo->prepare("SELECT * FROM contact_rate_limit WHERE ip = ?");
$stmt->execute([$ip]);
$rate = $stmt->fetch(PDO::FETCH_ASSOC);

if ($rate) {
    if (time() - $rate['window_start'] > $window) {
        // Window expired, reset
        $stmt = $pdo->prepare("UPDATE contact_rate_limit SET count=1, window_start=? WHERE ip=?");
        $stmt->execute([time(), $ip]);
    } elseif ($rate['count'] >= $limit) {
        fail($pdo, 'rate_limited', "IP $ip exceeded rate limit");
    } else {
        // Increment counter
        $stmt = $pdo->prepare("UPDATE contact_rate_limit SET count=count+1 WHERE ip=?");
        $stmt->execute([$ip]);
    }
} else {
    // First submission from this IP
    $stmt = $pdo->prepare("INSERT INTO contact_rate_limit (ip, count, window_start) VALUES (?,1,?)");
    $stmt->execute([$ip, time()]);
}

/* ───────────────── RECAPTCHA v3 VALIDATION ───────────────── */
$recaptchaToken = $_POST['recaptcha_token'] ?? '';

if (empty($recaptchaToken)) {
    fail($pdo, 'recaptcha_missing', 'No reCAPTCHA token provided');
}

// Load security config
$security = require __DIR__ . '/../app/config/security.php';
$secretKey = $security['recaptcha_secret'] ?? '';

if (empty($secretKey)) {
    fail($pdo, 'recaptcha_config_error', 'Missing reCAPTCHA secret key');
}

// Verify token with Google
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify",
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query([
        'secret' => $secretKey,
        'response' => $recaptchaToken,
        'remoteip' => $ip
    ]),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 5,
    CURLOPT_CONNECTTIMEOUT => 3,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// Handle network errors
if ($response === false || $httpCode !== 200) {
    fail($pdo, 'recaptcha_network_error', "Google API returned $httpCode: $curlError");
}

// Parse JSON response
$data = json_decode($response, true);
if (!is_array($data)) {
    fail($pdo, 'recaptcha_invalid_response', 'Invalid JSON from Google');
}

// Validate reCAPTCHA response
if (!($data['success'] ?? false)) {
    fail($pdo, 'recaptcha_failed', 'reCAPTCHA validation failed: ' . json_encode($data['error-codes'] ?? []));
}

// Check score (0.0 to 1.0, where 1.0 is most likely human)
if (($data['score'] ?? 0) < 0.5) {
    fail($pdo, 'recaptcha_low_score', 'Score too low: ' . $data['score']);
}

// Verify action matches
if (($data['action'] ?? '') !== 'contact') {
    fail($pdo, 'recaptcha_invalid_action', 'Expected action "contact", got "' . $data['action'] . '"');
}

// Verify hostname (security check)
if (!empty($data['hostname'])) {
    $allowedHosts = ['mepteam.pro', 'www.mepteam.pro', 'localhost', '127.0.0.1'];
    if (!in_array($data['hostname'], $allowedHosts, true)) {
        fail($pdo, 'recaptcha_invalid_hostname', 'Hostname mismatch: ' . $data['hostname']);
    }
}

/* ───────────────── SAVE MESSAGE TO DATABASE ───────────────── */
try {
    $stmt = $pdo->prepare("
        INSERT INTO contact_messages (name, email, message, lang, ip, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    $stmt->execute([$name, $email, $message, $lang, $ip]);
} catch (PDOException $e) {
    fail($pdo, 'database_error', 'Failed to save message: ' . $e->getMessage());
}

/* ───────────────── SEND EMAIL NOTIFICATION ───────────────── */
$safeName  = str_replace(["\r", "\n"], '', $name);
$safeEmail = str_replace(["\r", "\n"], '', $email);
$safeMessage = str_replace(["\r\r"], ["\r"], $message);  // Normalize line breaks

$headers = [
    "From: no-reply@mepteam.pro",
    "Reply-To: $safeEmail",
    "Content-Type: text/plain; charset=UTF-8",
    "X-Priority: 3"
];

$emailBody = <<<EOT
New Contact Form Submission
========================================

Name: $safeName
Email: $safeEmail
Language: $lang
IP Address: $ip
Submitted: " . date('Y-m-d H:i:s') . "

---

Message:

$safeMessage

========================================
Please reply to: $safeEmail
EOT;

@mail(
    "info@mepteam.pro",
    "[MEPTeam Pro] New Contact: $safeName",
    $emailBody,
    implode("\r\n", $headers)
);

/* ───────────────── SUCCESS RESPONSE ───────────────── */
header('Location: /?lang=' . urlencode($lang) . '&contact=success#contact', true, 302);
exit;