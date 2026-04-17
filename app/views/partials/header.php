<?php $lang = current_lang(); ?>
<!DOCTYPE html>
<html lang="<?= e($lang) ?>" dir="<?= is_rtl($lang) ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(site_text($pdo, 'site_title', $lang)) ?></title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
</head>
<body>

<header class="hero-shell">
    <div class="container">
        <div class="top-nav">
            <a class="brand" href="/?lang=<?= e($lang) ?>">
                <img
                    src="/assets/images/logo-horizontal.png"
                    alt="<?= e(site_text($pdo, 'site_title', $lang)) ?>"
                >
            </a>

            <nav class="main-nav" aria-label="Main navigation">
                <a href="/?lang=<?= e($lang) ?>"><?= e(site_text($pdo, 'nav_home', $lang)) ?></a>
                <a href="#about"><?= e(site_text($pdo, 'nav_about', $lang)) ?></a>
                <a href="#projects"><?= e(site_text($pdo, 'nav_projects', $lang)) ?></a>
                <a href="#services"><?= e(site_text($pdo, 'nav_services', $lang)) ?></a>
                <a href="#contact"><?= e(site_text($pdo, 'nav_contact', $lang)) ?></a>
            </nav>

            <div class="nav-right">
                <div class="lang-switch" aria-label="Language switcher">
                    <a href="/?lang=ar"><?= e(site_text($pdo, 'lang_ar', $lang)) ?></a>
                    <a href="/?lang=fr"><?= e(site_text($pdo, 'lang_fr', $lang)) ?></a>
                    <a href="/?lang=en"><?= e(site_text($pdo, 'lang_en', $lang)) ?></a>
                </div>

                <button
                    id="theme-toggle"
                    class="theme-toggle"
                    type="button"
                    aria-label="Toggle theme"
                >🌙</button>

                <button
                    id="menu-toggle"
                    class="menu-toggle"
                    type="button"
                    aria-label="Open menu"
                    aria-expanded="false"
                >☰</button>
            </div>

            <div id="mobile-panel" class="mobile-panel" aria-label="Mobile menu">
                <nav class="mobile-nav">
                    <a href="/?lang=<?= e($lang) ?>"><?= e(site_text($pdo, 'nav_home', $lang)) ?></a>
                    <a href="#about"><?= e(site_text($pdo, 'nav_about', $lang)) ?></a>
                    <a href="#projects"><?= e(site_text($pdo, 'nav_projects', $lang)) ?></a>
                    <a href="#services"><?= e(site_text($pdo, 'nav_services', $lang)) ?></a>
                    <a href="#contact"><?= e(site_text($pdo, 'nav_contact', $lang)) ?></a>
                </nav>

                <div class="mobile-lang-switch">
                    <a href="/?lang=ar"><?= e(site_text($pdo, 'lang_ar', $lang)) ?></a>
                    <a href="/?lang=fr"><?= e(site_text($pdo, 'lang_fr', $lang)) ?></a>
                    <a href="/?lang=en"><?= e(site_text($pdo, 'lang_en', $lang)) ?></a>
                </div>
            </div>
        </div>
    </div>
</header>