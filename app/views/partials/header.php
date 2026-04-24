<?php
$lang = current_lang();

// Generate or regenerate CSRF token for the contact form (always fresh on page load)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Always regenerate to ensure fresh token after form submission
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$_SESSION['csrf_token_time'] = time();
$csrfToken = $_SESSION['csrf_token'];

// Determine the current page for aria-current and meta tags
$currentPage = $_GET['page'] ?? 'home';
$currentSlug = $_GET['slug'] ?? '';

// Build a page-specific <title> and meta description
$pageTitle       = e(site_text($pdo, 'site_title', $lang));
$metaDescription = e(site_text($pdo, 'hero_subtitle', $lang));

if ($currentPage === 'service-details' && !empty($currentSlug)) {
    $serviceMap = [
        'mechanical'     => 'service_1_title',
        'hvac'           => 'service_2_title',
        'fire-protection'=> 'service_3_title',
        'electrical'     => 'service_4_title',
        'plumbing'       => 'service_5_title',
        'elv'            => 'service_6_title',
        'water-steel'    => 'service_7_title',
    ];
    if (isset($serviceMap[$currentSlug])) {
        $serviceTitle    = e(site_text($pdo, $serviceMap[$currentSlug], $lang));
        $pageTitle       = $serviceTitle . ' — ' . $pageTitle;
        $metaDescription = e(site_text($pdo, str_replace('_title', '_desc', $serviceMap[$currentSlug]), $lang));
    }
}

// Helper: mark nav links with aria-current
function nav_aria(string $href, string $currentPage): string
{
    // Home link
    if ($href === 'home' && $currentPage === 'home') {
        return ' aria-current="page"';
    }
    return '';
}
?>
<!DOCTYPE html>
<html lang="<?= e($lang) ?>" dir="<?= is_rtl($lang) ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <meta name="description" content="<?= $metaDescription ?>">

    <!-- Open Graph (LinkedIn, WhatsApp, Facebook) -->
    <meta property="og:title"       content="<?= $pageTitle ?>">
    <meta property="og:description" content="<?= $metaDescription ?>">
    <meta property="og:type"        content="website">
    <meta property="og:locale"      content="<?= e($lang) ?>">
    <meta property="og:url"         content="https://mepteampro.com<?= e($_SERVER['REQUEST_URI'] ?? '/') ?>">
    <meta property="og:image"       content="https://mepteampro.com/assets/images/og-image.jpg">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt"   content="<?= $pageTitle ?>">
    <meta property="og:site_name"   content="MEPTeam Pro">

    <!-- Twitter / X Card (also used by WhatsApp as fallback) -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?= $pageTitle ?>">
    <meta name="twitter:description" content="<?= $metaDescription ?>">
    <meta name="twitter:image"       content="https://mepteampro.com/assets/images/og-image.jpg">

    <!-- schema.org LocalBusiness structured data (Google rich results) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "MEPTeam Pro",
        "description": "Experts in mechanical, electrical, plumbing and fire protection engineering for residential, industrial, healthcare and pharmaceutical projects.",
        "url": "https://mepteampro.com",
        "logo": "https://mepteampro.com/assets/images/logo-horizontal.png",
        "image": "https://mepteampro.com/assets/images/og-image.jpg",
        "telephone": "+96171212368",
        "email": "info@mepteampro.com",
        "foundingDate": "2014",
        "areaServed": [
            { "@type": "Country", "name": "Lebanon" },
            { "@type": "Country", "name": "United Arab Emirates" }
        ],
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "LB"
        },
        "sameAs": [
            "https://www.linkedin.com/company/mepteampro"
        ],
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "MEP Engineering Services",
            "itemListElement": [
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Mechanical Engineering" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "HVAC Design" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Fire Protection Engineering" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Electrical Engineering" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Plumbing Engineering" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "ELV Systems" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Water & Steel Engineering" } }
            ]
        }
    }
    </script>

    <!-- Favicon -->
    <link rel="icon"             type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
    <link rel="icon"             type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon"                               href="/assets/images/apple-touch-icon.png">

    <!-- Third-party CSS (each loaded exactly once) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <!-- Site CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
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
                <a href="/?lang=<?= e($lang) ?>"<?= nav_aria('home', $currentPage) ?>>
                    <?= e(site_text($pdo, 'nav_home', $lang)) ?>
                </a>
                <a href="<?= $currentPage === 'home' ? '#about' : '/?lang=' . e($lang) . '#about' ?>">
                    <?= e(site_text($pdo, 'nav_about', $lang)) ?>
                </a>
                <a href="<?= $currentPage === 'home' ? '#projects' : '/?lang=' . e($lang) . '#projects' ?>">
                    <?= e(site_text($pdo, 'nav_projects', $lang)) ?>
                </a>
                <a href="<?= $currentPage === 'home' ? '#services' : '/?lang=' . e($lang) . '#services' ?>">
                    <?= e(site_text($pdo, 'nav_services', $lang)) ?>
                </a>
                <a href="<?= $currentPage === 'home' ? '#contact' : '/?lang=' . e($lang) . '#contact' ?>">
                    <?= e(site_text($pdo, 'nav_contact', $lang)) ?>
                </a>
            </nav>

            <div class="nav-right">

                <div class="lang-switch" aria-label="Language switcher">
                    <a href="/?lang=ar" class="lang-flag <?= $lang === 'ar' ? 'active' : '' ?>" hreflang="ar" aria-label="العربية">
                        <img src="/assets/images/flags/lb.png" alt="Arabic">
                    </a>
                    <a href="/?lang=fr" class="lang-flag <?= $lang === 'fr' ? 'active' : '' ?>" hreflang="fr" aria-label="Français">
                        <img src="/assets/images/flags/fr.png" alt="Français">
                    </a>
                    <a href="/?lang=en" class="lang-flag <?= $lang === 'en' ? 'active' : '' ?>" hreflang="en" aria-label="English">
                        <img src="/assets/images/flags/gb.png" alt="English">
                    </a>
                </div>

                <button
                    id="theme-toggle"
                    class="theme-toggle"
                    type="button"
                    aria-label="Toggle dark/light theme"
                    title="<?= $lang === 'fr' ? 'Changer le thème' : ($lang === 'ar' ? 'تغيير المظهر' : 'Toggle theme') ?>"
                >
                    <span class="theme-toggle-icon" aria-hidden="true">🌙</span>
                    <span class="theme-toggle-label"><?= $lang === 'fr' ? 'Thème' : ($lang === 'ar' ? 'مظهر' : 'Theme') ?></span>
                </button>

                <button
                    id="menu-toggle"
                    class="menu-toggle"
                    type="button"
                    aria-label="Open menu"
                    aria-expanded="false"
                    aria-controls="mobile-panel"
                >☰</button>

            </div>

            <div id="mobile-panel" class="mobile-panel" aria-label="Mobile menu">
                <nav class="mobile-nav">
                    <a href="/?lang=<?= e($lang) ?>"<?= nav_aria('home', $currentPage) ?>>
                        <?= e(site_text($pdo, 'nav_home', $lang)) ?>
                    </a>
                    <a href="<?= $currentPage === 'home' ? '#about' : '/?lang=' . e($lang) . '#about' ?>">
                        <?= e(site_text($pdo, 'nav_about', $lang)) ?>
                    </a>
                    <a href="<?= $currentPage === 'home' ? '#projects' : '/?lang=' . e($lang) . '#projects' ?>">
                        <?= e(site_text($pdo, 'nav_projects', $lang)) ?>
                    </a>
                    <a href="<?= $currentPage === 'home' ? '#services' : '/?lang=' . e($lang) . '#services' ?>">
                        <?= e(site_text($pdo, 'nav_services', $lang)) ?>
                    </a>
                    <a href="<?= $currentPage === 'home' ? '#contact' : '/?lang=' . e($lang) . '#contact' ?>">
                        <?= e(site_text($pdo, 'nav_contact', $lang)) ?>
                    </a>
                </nav>

                <div class="mobile-lang-switch">
                    <a href="/?lang=ar" class="lang-flag <?= $lang === 'ar' ? 'active' : '' ?>" hreflang="ar" aria-label="العربية">
                        <img src="/assets/images/flags/lb.png" alt="Arabic">
                    </a>
                    <a href="/?lang=fr" class="lang-flag <?= $lang === 'fr' ? 'active' : '' ?>" hreflang="fr" aria-label="Français">
                        <img src="/assets/images/flags/fr.png" alt="Français">
                    </a>
                    <a href="/?lang=en" class="lang-flag <?= $lang === 'en' ? 'active' : '' ?>" hreflang="en" aria-label="English">
                        <img src="/assets/images/flags/gb.png" alt="English">
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>