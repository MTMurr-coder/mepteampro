<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/config/Database.php';

$pdo = Database::connect();
$lang = current_lang();
$page = $_GET['page'] ?? 'home';

/**
 * Helper: fetch rows with automatic English fallback.
 * Runs a single prepare and at most two executes.
 */
function fetch_with_fallback(PDO $pdo, string $sql, string $lang, bool $single = false): mixed
{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lang]);
    $rows = $single ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows) && $lang !== 'en') {
        $stmt->execute(['en']);
        $rows = $single ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $rows ?: ($single ? null : []);
}

try {
    /** About */
    $about = fetch_with_fallback(
        $pdo,
        "SELECT content FROM about WHERE lang = ? LIMIT 1",
        $lang,
        true
    );

    /** Services */
    $services = fetch_with_fallback(
        $pdo,
        "SELECT title, description FROM services WHERE lang = ? ORDER BY id ASC",
        $lang
    );

    /** Projects — fetch once, reuse for cards AND map */
    $projects = fetch_with_fallback(
        $pdo,
        "SELECT id, title, description, img_url, country, city, area, latitude, longitude
         FROM projects
         WHERE lang = ?
         ORDER BY id ASC",
        $lang
    );

    // Derive map locations from the already-fetched project list (no second DB query)
    $projectLocations = array_values(array_filter($projects, static function (array $p): bool {
        return isset($p['latitude'], $p['longitude'])
            && $p['latitude'] !== null
            && $p['longitude'] !== null;
    }));

    /** Offices */
    $offices = fetch_with_fallback(
        $pdo,
        "SELECT office_name, country, city, address_text, latitude, longitude
         FROM offices
         WHERE lang = ? AND is_active = 1
         ORDER BY id ASC",
        $lang
    );

} catch (Throwable $e) {
    error_log('[MEPTeam] DB error in index.php: ' . $e->getMessage());
    // Provide safe empty defaults so the page still renders
    $about = null;
    $services = [];
    $projects = [];
    $projectLocations = [];
    $offices = [];
}

/** Simple page router */
switch ($page) {
    case 'service-details':
        require_once __DIR__ . '/../app/views/service-details.php';
        break;

    case 'home':
    default:
        require_once __DIR__ . '/../app/views/home.php';
        break;
}