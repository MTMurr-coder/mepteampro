<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/config/Database.php';

$pdo = Database::connect();
$lang = current_lang();

/**
 * About
 */
$stmt = $pdo->prepare("SELECT content FROM about WHERE lang = ? LIMIT 1");
$stmt->execute([$lang]);
$about = $stmt->fetch();

if (!$about && $lang !== 'en') {
    $stmt->execute(['en']);
    $about = $stmt->fetch();
}

/**
 * Services
 */
$stmt = $pdo->prepare("
    SELECT title, description
    FROM services
    WHERE lang = ?
    ORDER BY id ASC
");
$stmt->execute([$lang]);
$services = $stmt->fetchAll();

if (!$services && $lang !== 'en') {
    $stmt->execute(['en']);
    $services = $stmt->fetchAll();
}

/**
 * Projects
 */
$stmt = $pdo->prepare("
    SELECT id, title, description, img_url, country, city, latitude, longitude
    FROM projects
    WHERE lang = ?
    ORDER BY id ASC
");
$stmt->execute([$lang]);
$projects = $stmt->fetchAll();

if (!$projects && $lang !== 'en') {
    $stmt->execute(['en']);
    $projects = $stmt->fetchAll();
}

/**
 * Project locations
 */
$stmt = $pdo->prepare("
    SELECT title, country, city, latitude, longitude
    FROM projects
    WHERE lang = ?
      AND latitude IS NOT NULL
      AND longitude IS NOT NULL
    ORDER BY id ASC
");
$stmt->execute([$lang]);
$projectLocations = $stmt->fetchAll();

if (!$projectLocations && $lang !== 'en') {
    $stmt->execute(['en']);
    $projectLocations = $stmt->fetchAll();
}

/**
 * Offices
 */
$stmt = $pdo->prepare("
    SELECT office_name, country, city, address_text, latitude, longitude
    FROM offices
    WHERE lang = ?
      AND is_active = 1
    ORDER BY id ASC
");
$stmt->execute([$lang]);
$offices = $stmt->fetchAll();

if (!$offices && $lang !== 'en') {
    $stmt->execute(['en']);
    $offices = $stmt->fetchAll();
}

require_once __DIR__ . '/../app/views/home.php';