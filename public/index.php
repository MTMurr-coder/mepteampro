<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/config/Database.php';

$pdo = Database::connect();
$lang = current_lang();

$stmtAbout = $pdo->prepare("SELECT content FROM about WHERE lang = ? LIMIT 1");
$stmtAbout->execute([$lang]);
$about = $stmtAbout->fetch();

if (!$about && $lang !== 'en') {
    $stmtAbout->execute(['en']);
    $about = $stmtAbout->fetch();
}

$stmtServices = $pdo->prepare("SELECT title, description FROM services WHERE lang = ? ORDER BY id ASC");
$stmtServices->execute([$lang]);
$services = $stmtServices->fetchAll();

if (!$services && $lang !== 'en') {
    $stmtServices->execute(['en']);
    $services = $stmtServices->fetchAll();
}

$stmtProjects = $pdo->prepare("SELECT title, description, img_url FROM projects WHERE lang = ? ORDER BY id ASC");
$stmtProjects->execute([$lang]);
$projects = $stmtProjects->fetchAll();

if (!$projects && $lang !== 'en') {
    $stmtProjects->execute(['en']);
    $projects = $stmtProjects->fetchAll();
}

$dir = is_rtl($lang) ? 'rtl' : 'ltr';
?>
<!DOCTYPE html>
<html lang="<?= e($lang) ?>" dir="<?= e($dir) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEP Team Pro</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #08111d;
            color: #eef4ff;
        }
        .container {
            width: min(1100px, calc(100% - 32px));
            margin: 0 auto;
        }
        header {
            padding: 20px 0;
            border-bottom: 1px solid rgba(255,255,255,.1);
            background: #0b1522;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .langs a {
            color: #fff;
            margin-left: 10px;
            text-decoration: none;
            padding: 8px 12px;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 999px;
        }
        .hero, section {
            padding: 48px 0;
        }
        h1, h2, h3 {
            margin-top: 0;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }
        .card {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 18px;
            padding: 20px;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <nav>
            <div class="brand">MEP Team Pro</div>
            <div class="langs">
                <a href="?lang=en">EN</a>
                <a href="?lang=fr">FR</a>
                <a href="?lang=ar">AR</a>
            </div>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="container">
        <h1>MEP Team Pro</h1>
        <p><?= e($about['content'] ?? 'Professional MEP solutions.') ?></p>
    </div>
</section>

<section>
    <div class="container">
        <h2>Services</h2>
        <div class="grid">
            <?php foreach ($services as $service): ?>
                <div class="card">
                    <h3><?= e($service['title']) ?></h3>
                    <p><?= e($service['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <h2>Projects</h2>
        <div class="grid">
            <?php foreach ($projects as $project): ?>
                <div class="card">
                    <h3><?= e($project['title']) ?></h3>
                    <p><?= e($project['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</body>
</html>