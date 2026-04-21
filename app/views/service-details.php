<?php
$slug = $_GET['slug'] ?? '';

$serviceMap = [
    'mechanical' => [
        'title_key' => 'service_1_title',
        'desc_key' => 'service_1_desc',
        'long_desc_key' => 'service_1_long_desc',
        'items' => ['service_1_item_1', 'service_1_item_2', 'service_1_item_3'],
        'icon' => 'fas fa-cog',
        'hero_class' => 'service-detail-mechanical',
    ],
    'hvac' => [
        'title_key' => 'service_2_title',
        'desc_key' => 'service_2_desc',
        'long_desc_key' => 'service_2_long_desc',
        'items' => ['service_2_item_1', 'service_2_item_2', 'service_2_item_3'],
        'icon' => 'fas fa-fan',
        'hero_class' => 'service-detail-hvac',
    ],
    'fire-protection' => [
        'title_key' => 'service_3_title',
        'desc_key' => 'service_3_desc',
        'long_desc_key' => 'service_3_long_desc',
        'items' => ['service_3_item_1', 'service_3_item_2', 'service_3_item_3'],
        'icon' => 'fas fa-fire',
        'hero_class' => 'service-detail-fire',
    ],
    'electrical' => [
        'title_key' => 'service_4_title',
        'desc_key' => 'service_4_desc',
        'long_desc_key' => 'service_4_long_desc',
        'items' => ['service_4_item_1', 'service_4_item_2', 'service_4_item_3'],
        'icon' => 'fas fa-bolt',
        'hero_class' => 'service-detail-electrical',
    ],
    'plumbing' => [
        'title_key' => 'service_5_title',
        'desc_key' => 'service_5_desc',
        'long_desc_key' => 'service_5_long_desc',
        'items' => ['service_5_item_1', 'service_5_item_2', 'service_5_item_3'],
        'icon' => 'fas fa-tint',
        'hero_class' => 'service-detail-plumbing',
    ],
    'elv' => [
        'title_key' => 'service_6_title',
        'desc_key' => 'service_6_desc',
        'long_desc_key' => 'service_6_long_desc',
        'items' => ['service_6_item_1', 'service_6_item_2', 'service_6_item_3'],
        'icon' => 'fas fa-video',
        'hero_class' => 'service-detail-elv',
    ],
    'water-steel' => [
        'title_key' => 'service_7_title',
        'desc_key' => 'service_7_desc',
        'long_desc_key' => 'service_7_long_desc',
        'items' => ['service_7_item_1', 'service_7_item_2', 'service_7_item_3'],
        'icon' => 'fas fa-water',
        'hero_class' => 'service-detail-water',
    ],
];

if (!isset($serviceMap[$slug])) {
    $serviceNotFound = true;
} else {
    $serviceNotFound = false;
    $service = $serviceMap[$slug];
}
?>

<?php require_once __DIR__ . '/partials/header.php'; ?>

<?php if ($serviceNotFound): ?>
    <main class="service-page">
        <section class="service-detail-hero">
            <div class="container">
                <div class="service-not-found">
                    <h1><?= e(site_text($pdo, 'service_not_found_title', $lang)) ?></h1>
                    <p><?= e(site_text($pdo, 'service_not_found_text', $lang)) ?></p>
                    <a href="?page=home&lang=<?= urlencode($lang) ?>#services" class="btn-primary">
                        <?= e(site_text($pdo, 'services_title', $lang)) ?>
                    </a>
                </div>
            </div>
        </section>
    </main>
<?php else: ?>
    <main class="service-page">
        <section class="service-detail-hero <?= e($service['hero_class']) ?>">
            <div class="container">
                <div class="service-breadcrumb">
                    <a href="?page=home&lang=<?= urlencode($lang) ?>">
                        <?= e(site_text($pdo, 'service_breadcrumb_home', $lang)) ?>
                    </a>
                    <span>/</span>
                    <a href="?page=home&lang=<?= urlencode($lang) ?>#services">
                        <?= e(site_text($pdo, 'services_title', $lang)) ?>
                    </a>
                    <span>/</span>
                    <strong><?= e(site_text($pdo, $service['title_key'], $lang)) ?></strong>
                </div>

                <div class="service-hero-grid">
                    <div class="service-hero-content">
                        <div class="service-detail-icon">
                            <i class="<?= e($service['icon']) ?>"></i>
                        </div>

                        <p class="service-kicker">
                            <?= e(site_text($pdo, 'services_title', $lang)) ?>
                        </p>

                        <h1><?= e(site_text($pdo, $service['title_key'], $lang)) ?></h1>

                        <p class="service-detail-intro">
                            <?= e(site_text($pdo, $service['desc_key'], $lang)) ?>
                        </p>

                        <div class="service-detail-actions">
                            <a href="?page=home&lang=<?= urlencode($lang) ?>#contact" class="btn-primary">
                                <?= e(site_text($pdo, 'contact_title', $lang)) ?>
                            </a>

                            <a href="?page=home&lang=<?= urlencode($lang) ?>#services" class="btn-secondary">
                                <?= e(site_text($pdo, 'services_title', $lang)) ?>
                            </a>
                        </div>
                    </div>

                    <div class="service-hero-card">
                        <h2><?= e(site_text($pdo, 'service_section_features', $lang)) ?></h2>
                        <ul class="service-feature-list">
                            <?php foreach ($service['items'] as $itemKey): ?>
                                <li><?= e(site_text($pdo, $itemKey, $lang)) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="service-detail-section section">
            <div class="container">
                <div class="service-detail-layout">
                    <div class="service-detail-main">
                        <div class="service-content-card">
                            <h2><?= e(site_text($pdo, 'service_section_overview', $lang)) ?></h2>
                            <p><?= e(site_text($pdo, $service['long_desc_key'], $lang)) ?></p>
                        </div>

                        <div class="service-content-card">
                            <h3><?= e(site_text($pdo, 'service_section_features', $lang)) ?></h3>
                            <ul class="service-detail-list">
                                <?php foreach ($service['items'] as $itemKey): ?>
                                    <li><?= e(site_text($pdo, $itemKey, $lang)) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <aside class="service-detail-sidebar">
                        <div class="service-side-card">
                            <h3><?= e(site_text($pdo, 'services_title', $lang)) ?></h3>
                            <ul class="service-side-links">
                                <li><a href="?page=service-details&slug=mechanical&lang=<?= urlencode($lang) ?>"><?= e(site_text($pdo, 'service_1_title', $lang)) ?></a></li>
                                <li><a href="?page=service-details&slug=hvac&lang=<?= urlencode($lang) ?>"><?= e(site_text($pdo, 'service_2_title', $lang)) ?></a></li>
                                <li><a href="?page=service-details&slug=fire-protection&lang=<?= urlencode($lang) ?>"><?= e(site_text($pdo, 'service_3_title', $lang)) ?></a></li>
                                <li><a href="?page=service-details&slug=electrical&lang=<?= urlencode($lang) ?>"><?= e(site_text($pdo, 'service_4_title', $lang)) ?></a></li>
                                <li><a href="?page=service-details&slug=plumbing&lang=<?= urlencode($lang) ?>"><?= e(site_text($pdo, 'service_5_title', $lang)) ?></a></li>
                                <li><a href="?page=service-details&slug=elv&lang=<?= urlencode($lang) ?>"><?= e(site_text($pdo, 'service_6_title', $lang)) ?></a></li>
                                <li><a href="?page=service-details&slug=water-steel&lang=<?= urlencode($lang) ?>"><?= e(site_text($pdo, 'service_7_title', $lang)) ?></a></li>
                            </ul>
                        </div>

                        <div class="service-side-card service-side-cta">
                            <h3><?= e(site_text($pdo, 'contact_title', $lang)) ?></h3>
                            <p><?= e(site_text($pdo, 'services_intro', $lang)) ?></p>
                            <a href="?page=home&lang=<?= urlencode($lang) ?>#contact" class="btn-primary">
                                <?= e(site_text($pdo, 'contact_title', $lang)) ?>
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>