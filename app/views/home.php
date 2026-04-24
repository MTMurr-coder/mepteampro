<?php require __DIR__ . '/partials/header.php'; ?>

<main>
<section class="hero-v2">
    <div class="container">
        <div class="hero-inner">

            <div class="hero-left">

                <?php
                    // Split the long headline into a short punchy line + sector tagline.
                    // Falls back gracefully if the DB key is not yet split.
                    $heroShort  = site_text($pdo, 'hero_main_title_short', $lang);
                    $heroSectors = site_text($pdo, 'hero_main_title_sectors', $lang);
                    $heroFull   = site_text($pdo, 'hero_main_title', $lang);
                ?>

                <?php if ($heroShort): ?>
                    <h1><?= e($heroShort) ?></h1>
                    <?php if ($heroSectors): ?>
                        <p class="hero-sectors"><?= e($heroSectors) ?></p>
                    <?php endif; ?>
                <?php else: ?>
                    <h1><?= e($heroFull) ?></h1>
                <?php endif; ?>

                <p class="hero-sub">
                    <?= e(site_text($pdo, 'hero_subtitle', $lang)) ?>
                </p>

                <div class="hero-actions">
                    <!-- Primary CTA: solid orange fill -->
                    <a href="#services" class="btn-primary">
                        <?= e(site_text($pdo, 'hero_btn_primary', $lang)) ?>
                    </a>

                    <!-- Secondary CTA: ghost style (outline only, no white fill) -->
                    <a href="#projects" class="btn-ghost">
                        <?= e(site_text($pdo, 'hero_btn_secondary', $lang)) ?>
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat">
                        <strong><?= e(site_text($pdo, 'stat_1_value', $lang)) ?></strong>
                        <span><?= e(site_text($pdo, 'stat_1_label', $lang)) ?></span>
                    </div>

                    <div class="stat">
                        <strong><?= e(site_text($pdo, 'stat_2_value', $lang)) ?></strong>
                        <span><?= e(site_text($pdo, 'stat_2_label', $lang)) ?></span>
                    </div>

                    <div class="stat">
                        <strong><?= e(site_text($pdo, 'stat_3_value', $lang)) ?></strong>
                        <span><?= e(site_text($pdo, 'stat_3_label', $lang)) ?></span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<section class="about-section section" id="about">
    <div class="container">

        <!-- ── Section header ──────────────────────────────────── -->
        <div class="about-header">
            <h2 class="section-title">
                <?= e(site_text($pdo, 'about_title', $lang)) ?>
            </h2>
            <?php $aboutIntro = site_text($pdo, 'about_intro', $lang); ?>
            <?php if (!empty($aboutIntro)): ?>
                <p class="section-lead">
                    <?= e($aboutIntro) ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- ── Two-column layout ───────────────────────────────── -->
        <div class="about-shell">

            <!-- LEFT: image + vision/mission/aim cards -->
            <div class="about-left">

                <figure class="about-image-wrap">
                    <img src="assets/images/about.jpg"
                         alt="<?= e(site_text($pdo, 'about_title', $lang)) ?>">
                    <?php $imgCaption = site_text($pdo, 'about_image_caption', $lang); ?>
                    <?php if (!empty($imgCaption)): ?>
                        <figcaption class="about-image-caption">
                            <?= e($imgCaption) ?>
                        </figcaption>
                    <?php endif; ?>
                </figure>

                <!-- Vision / Mission / Aim — distinct bordered cards -->
                <div class="about-vma-grid">
                    <div class="about-vma-card">
                        <span class="about-vma-icon"><i class="fa-solid fa-eye"></i></span>
                        <div>
                            <h3><?= e(site_text($pdo, 'about_vision_title', $lang)) ?></h3>
                            <p><?= e(site_text($pdo, 'about_vision_text', $lang)) ?></p>
                        </div>
                    </div>
                    <div class="about-vma-card">
                        <span class="about-vma-icon"><i class="fa-solid fa-rocket"></i></span>
                        <div>
                            <h3><?= e(site_text($pdo, 'about_mission_title', $lang)) ?></h3>
                            <p><?= e(site_text($pdo, 'about_mission_text', $lang)) ?></p>
                        </div>
                    </div>
                    <div class="about-vma-card">
                        <span class="about-vma-icon"><i class="fa-solid fa-bullseye"></i></span>
                        <div>
                            <h3><?= e(site_text($pdo, 'about_aim_title', $lang)) ?></h3>
                            <p><?= e(site_text($pdo, 'about_aim_text', $lang)) ?></p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT: core values grid -->
            <div class="about-right">

                <h2 class="about-subsection-title">
                    <?= e(site_text($pdo, 'about_beliefs_title', $lang)) ?>
                </h2>

                <div class="about-beliefs-grid">
                    <div class="about-belief-card">
                        <div class="about-belief-icon"><i class="fa-solid fa-bolt"></i></div>
                        <h4><?= e(site_text($pdo, 'about_belief_1_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_1_text', $lang)) ?></p>
                    </div>
                    <div class="about-belief-card">
                        <div class="about-belief-icon"><i class="fa-solid fa-users"></i></div>
                        <h4><?= e(site_text($pdo, 'about_belief_2_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_2_text', $lang)) ?></p>
                    </div>
                    <div class="about-belief-card">
                        <div class="about-belief-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <h4><?= e(site_text($pdo, 'about_belief_3_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_3_text', $lang)) ?></p>
                    </div>
                    <div class="about-belief-card">
                        <div class="about-belief-icon"><i class="fa-solid fa-circle-check"></i></div>
                        <h4><?= e(site_text($pdo, 'about_belief_4_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_4_text', $lang)) ?></p>
                    </div>
                    <div class="about-belief-card">
                        <div class="about-belief-icon"><i class="fa-solid fa-comments"></i></div>
                        <h4><?= e(site_text($pdo, 'about_belief_5_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_5_text', $lang)) ?></p>
                    </div>
                    <div class="about-belief-card">
                        <div class="about-belief-icon"><i class="fa-solid fa-star"></i></div>
                        <h4><?= e(site_text($pdo, 'about_belief_6_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_6_text', $lang)) ?></p>
                    </div>
                </div>

            </div>

        </div>

        <!-- ── Why choose us — single instance, full width ─────── -->
        <div class="about-advantages-wrap">
            <h2 class="about-subsection-title">
                <?= e(site_text($pdo, 'about_advantages_title', $lang)) ?>
            </h2>
            <ul class="about-advantages-list">
                <li><?= e(site_text($pdo, 'about_advantage_1', $lang)) ?></li>
                <li><?= e(site_text($pdo, 'about_advantage_2', $lang)) ?></li>
                <li><?= e(site_text($pdo, 'about_advantage_3', $lang)) ?></li>
                <li><?= e(site_text($pdo, 'about_advantage_4', $lang)) ?></li>
                <li><?= e(site_text($pdo, 'about_advantage_5', $lang)) ?></li>
                <li><?= e(site_text($pdo, 'about_advantage_6', $lang)) ?></li>
            </ul>
        </div>

        <!-- ── Bottom CTA ──────────────────────────────────────── -->
        <div class="about-cta">
            <a href="#services" class="btn-primary">
                <?= e(site_text($pdo, 'nav_services', $lang)) ?>
            </a>
            <a href="#contact" class="btn-ghost">
                <?= e(site_text($pdo, 'contact_title', $lang)) ?>
            </a>
        </div>

    </div>
</section>
<section class="services-section section" id="services">
    <div class="container">

        <div class="services-header">
            <h2 class="section-title">
                <?= e(site_text($pdo, 'services_title', $lang)) ?>
            </h2>
            <?php $servicesIntro = site_text($pdo, 'services_intro', $lang); ?>
            <?php if (!empty($servicesIntro)): ?>
                <p class="section-lead"><?= e($servicesIntro) ?></p>
            <?php endif; ?>
        </div>

        <div class="services-grid">

            <article class="service-card">
                <div class="service-icon"><i class="fa-solid fa-gear"></i></div>
                <h3><?= e(site_text($pdo, 'service_1_title', $lang)) ?></h3>
                <p class="service-desc"><?= e(site_text($pdo, 'service_1_desc', $lang)) ?></p>
                <ul class="service-list">
                    <li><?= e(site_text($pdo, 'service_1_item_1', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_1_item_2', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_1_item_3', $lang)) ?></li>
                </ul>
                <a href="?page=service-details&slug=mechanical&lang=<?= urlencode($lang) ?>" class="service-link">
                    <span><?= e(site_text($pdo, 'learn_more', $lang)) ?></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </article>

            <article class="service-card">
                <div class="service-icon"><i class="fa-solid fa-wind"></i></div>
                <h3><?= e(site_text($pdo, 'service_2_title', $lang)) ?></h3>
                <p class="service-desc"><?= e(site_text($pdo, 'service_2_desc', $lang)) ?></p>
                <ul class="service-list">
                    <li><?= e(site_text($pdo, 'service_2_item_1', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_2_item_2', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_2_item_3', $lang)) ?></li>
                </ul>
                <a href="?page=service-details&slug=hvac&lang=<?= urlencode($lang) ?>" class="service-link">
                    <span><?= e(site_text($pdo, 'learn_more', $lang)) ?></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </article>

            <article class="service-card">
                <div class="service-icon"><i class="fa-solid fa-fire-flame-simple"></i></div>
                <h3><?= e(site_text($pdo, 'service_3_title', $lang)) ?></h3>
                <p class="service-desc"><?= e(site_text($pdo, 'service_3_desc', $lang)) ?></p>
                <ul class="service-list">
                    <li><?= e(site_text($pdo, 'service_3_item_1', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_3_item_2', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_3_item_3', $lang)) ?></li>
                </ul>
                <a href="?page=service-details&slug=fire-protection&lang=<?= urlencode($lang) ?>" class="service-link">
                    <span><?= e(site_text($pdo, 'learn_more', $lang)) ?></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </article>

            <article class="service-card">
                <div class="service-icon"><i class="fa-solid fa-bolt"></i></div>
                <h3><?= e(site_text($pdo, 'service_4_title', $lang)) ?></h3>
                <p class="service-desc"><?= e(site_text($pdo, 'service_4_desc', $lang)) ?></p>
                <ul class="service-list">
                    <li><?= e(site_text($pdo, 'service_4_item_1', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_4_item_2', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_4_item_3', $lang)) ?></li>
                </ul>
                <a href="?page=service-details&slug=electrical&lang=<?= urlencode($lang) ?>" class="service-link">
                    <span><?= e(site_text($pdo, 'learn_more', $lang)) ?></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </article>

            <article class="service-card">
                <div class="service-icon"><i class="fa-solid fa-droplet"></i></div>
                <h3><?= e(site_text($pdo, 'service_5_title', $lang)) ?></h3>
                <p class="service-desc"><?= e(site_text($pdo, 'service_5_desc', $lang)) ?></p>
                <ul class="service-list">
                    <li><?= e(site_text($pdo, 'service_5_item_1', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_5_item_2', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_5_item_3', $lang)) ?></li>
                </ul>
                <a href="?page=service-details&slug=plumbing&lang=<?= urlencode($lang) ?>" class="service-link">
                    <span><?= e(site_text($pdo, 'learn_more', $lang)) ?></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </article>

            <article class="service-card">
                <div class="service-icon"><i class="fa-solid fa-camera"></i></div>
                <h3><?= e(site_text($pdo, 'service_6_title', $lang)) ?></h3>
                <p class="service-desc"><?= e(site_text($pdo, 'service_6_desc', $lang)) ?></p>
                <ul class="service-list">
                    <li><?= e(site_text($pdo, 'service_6_item_1', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_6_item_2', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_6_item_3', $lang)) ?></li>
                </ul>
                <a href="?page=service-details&slug=elv&lang=<?= urlencode($lang) ?>" class="service-link">
                    <span><?= e(site_text($pdo, 'learn_more', $lang)) ?></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </article>

            <article class="service-card">
                <div class="service-icon"><i class="fa-solid fa-water"></i></div>
                <h3><?= e(site_text($pdo, 'service_7_title', $lang)) ?></h3>
                <p class="service-desc"><?= e(site_text($pdo, 'service_7_desc', $lang)) ?></p>
                <ul class="service-list">
                    <li><?= e(site_text($pdo, 'service_7_item_1', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_7_item_2', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_7_item_3', $lang)) ?></li>
                </ul>
                <a href="?page=service-details&slug=water-steel&lang=<?= urlencode($lang) ?>" class="service-link">
                    <span><?= e(site_text($pdo, 'learn_more', $lang)) ?></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </article>

        </div>

        <p class="services-footer-cta">
            <?= e(site_text($pdo, 'services_cta_question', $lang) ?: ($lang === 'fr' ? 'Vous ne savez pas quel service correspond à votre projet ?' : ($lang === 'ar' ? 'لست متأكداً من الخدمة المناسبة لمشروعك؟' : 'Not sure which service fits your project?'))) ?>
            <a href="#contact" class="services-cta-link">
                <?= e(site_text($pdo, 'services_cta_link', $lang) ?: ($lang === 'fr' ? 'Parlez à notre équipe →' : ($lang === 'ar' ? 'تحدث مع فريقنا ←' : 'Talk to our team →'))) ?>
            </a>
        </p>

    </div>
</section>

<section class="portfolio-section section" id="projects">
    <div class="container">

        <div class="projects-heading">
            <h2 class="section-title">
                <?= e(site_text($pdo, 'projects_title', $lang)) ?>
            </h2>
            <p class="section-lead">
                <?= e(site_text($pdo, 'projects_intro', $lang)) ?>
            </p>
        </div>

<?php if (!empty($projects)): ?>
    <?php
        $countries = [];
        foreach ($projects as $project) {
            $country = trim((string)($project['country'] ?? ''));
            if ($country !== '') {
                $countries[$country] = $country;
            }
        }
        ksort($countries);
        $totalProjects = count($projects);
    ?>

    <!-- Country filter tabs -->
    <div class="projects-filter-wrap">
        <div class="projects-country-tabs" id="projectCountryTabs">
            <button type="button" class="project-country-tab active" data-country="all">
                <?= e(site_text($pdo, 'projects_filter_all', $lang)) ?>
            </button>
            <?php foreach ($countries as $country): ?>
                <button type="button" class="project-country-tab" data-country="<?= e($country) ?>">
                    <?= e($country) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="projects-mobile-filter" id="projectsMobileFilter">
            <button type="button" class="projects-mobile-filter-toggle" id="projectsMobileFilterToggle">
                <i class="fas fa-bars"></i>
                <span><?= e(site_text($pdo, 'projects_filter_label', $lang)) ?></span>
            </button>
            <div class="projects-mobile-filter-menu" id="projectsMobileFilterMenu">
                <button type="button" class="projects-mobile-filter-item active" data-country="all">
                    <?= e(site_text($pdo, 'projects_filter_all', $lang)) ?>
                </button>
                <?php foreach ($countries as $country): ?>
                    <button type="button" class="projects-mobile-filter-item" data-country="<?= e($country) ?>">
                        <?= e($country) ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Slider -->
    <div class="portfolio-slider" id="portfolioSlider" tabindex="0" aria-label="Project portfolio slider">
        <?php foreach ($projects as $index => $project): ?>
            <?php
                $country      = trim((string)($project['country'] ?? ''));
                $city         = trim((string)($project['city'] ?? ''));
                $locationLabel = trim(
                    $city .
                    (!empty($city) && !empty($country) ? ', ' : '') .
                    $country
                );
                $area = trim((string)($project['area'] ?? ''));
            ?>
            <div
                class="portfolio-slide <?= $index === 0 ? 'active' : '' ?>"
                data-country="<?= e($country) ?>"
                role="group"
                aria-label="Project <?= $index + 1 ?> of <?= $totalProjects ?>"
            >
                <!-- Image panel -->
                <div class="portfolio-image">
                    <img
                        src="<?= e($project['img_url']) ?>"
                        alt="<?= e($project['title']) ?>"
                        loading="<?= $index === 0 ? 'eager' : 'lazy' ?>"
                    >
                    <!-- Slide progress bar -->
                    <div class="portfolio-progress-bar">
                        <div class="portfolio-progress-fill"></div>
                    </div>
                </div>

                <!-- Content panel -->
                <div class="portfolio-content">

                    <!-- Counter -->
                    <div class="portfolio-count">
                        <span class="portfolioCurrent"><?= $index + 1 ?></span>
                        <span class="portfolio-count-separator"> / </span>
                        <span class="portfolioTotal"><?= $totalProjects ?></span>
                    </div>

                    <!-- Badges row: sector + area -->
                    <div class="portfolio-badges">
                        <?php if (!empty($project['sector'])): ?>
                            <span class="portfolio-badge portfolio-badge-sector">
                                <?= e($project['sector']) ?>
                            </span>
                        <?php endif; ?>
                        <?php if (!empty($area)): ?>
                            <span class="portfolio-badge portfolio-badge-area">
                                <i class="fas fa-ruler-combined"></i>
                                <?= e($area) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <h3><?= e($project['title']) ?></h3>

                    <p class="portfolio-desc">
                        <?= e($project['description']) ?>
                    </p>

                    <!-- Location -->
                    <?php if ($locationLabel !== ''): ?>
                        <div class="portfolio-location">
                            <i class="fas fa-location-dot"></i>
                            <span><?= e($locationLabel) ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Per-slide CTA -->
                    <a href="#contact" class="portfolio-slide-cta">
                        <?= e(site_text($pdo, 'projects_discuss_cta', $lang)
                            ?: ($lang === 'fr' ? 'Discuter de votre projet →'
                                : ($lang === 'ar' ? 'ناقش مشروعك ←'
                                    : 'Discuss your project →'))) ?>
                    </a>

                </div>
            </div>
        <?php endforeach; ?>

        <button class="portfolio-nav prev" type="button" aria-label="Previous project">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="portfolio-nav next" type="button" aria-label="Next project">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <!-- Section-level CTA below slider -->
    <div class="portfolio-section-cta">
        <p><?= e(site_text($pdo, 'projects_section_cta_text', $lang)
            ?: ($lang === 'fr' ? 'Vous avez un projet similaire en tête ?'
                : ($lang === 'ar' ? 'هل لديك مشروع مماثل؟'
                    : 'Have a similar project in mind?'))) ?>
        </p>
        <a href="#contact" class="btn-primary">
            <?= e(site_text($pdo, 'projects_section_cta_btn', $lang)
                ?: ($lang === 'fr' ? 'Contactez-nous'
                    : ($lang === 'ar' ? 'تواصل معنا'
                        : 'Get in touch'))) ?>
        </a>
    </div>

<?php endif; ?>
    </div>
</section>
<section class="map-showcase map-showcase-premium" id="presence">
    <div class="container">
        <div class="map-showcase-header">
            <span class="section-kicker">Global Footprint</span>
            <h2 class="section-title">Our Presence</h2>
            <p class="section-lead">
                Discover our offices and selected project locations across the regions where we operate.
            </p>
        </div>

        <div class="presence-stats">
            <div class="presence-stat">
                <strong>2</strong>
                <span>Office Locations</span>
            </div>
            <div class="presence-stat">
                <strong>8+</strong>
                <span>Countries Reached</span>
            </div>
            <div class="presence-stat">
                <strong>MEP</strong>
                <span>Design & Coordination</span>
            </div>
        </div>

        <div class="presence-legend">
            <span class="presence-legend-item">
                <span class="presence-dot presence-dot-office"></span>
                Offices
            </span>
            <span class="presence-legend-item">
                <span class="presence-dot presence-dot-project"></span>
                Projects
            </span>
        </div>

        <div class="map-card map-card-premium">
            <div class="map-card-top">
                <div>
                    <h3>Offices & Project Locations</h3>
                    <p>Selected locations across residential, industrial, healthcare, and technically demanding sectors.</p>
                </div>
            </div>

            <div class="map-frame">
                <div id="projects-map"></div>
            </div>
        </div>
    </div>
</section>
<section class="contact-section section" id="contact">
    <div class="container">

        <div class="contact-header">
            <h2 class="section-title">
                <?= e(site_text($pdo, 'contact_title', $lang)) ?>
            </h2>

            <p class="section-lead contact-lead">
                <?= e(site_text($pdo, 'contact_intro', $lang)) ?>
            </p>
        </div>

        <div class="contact-grid">

            <div class="contact-info-cards">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h3><?= e(site_text($pdo, 'contact_email_label', $lang)) ?></h3>
                        <p>
                            <a href="mailto:<?= e(site_text($pdo, 'contact_email_value', $lang)) ?>">
                                <?= e(site_text($pdo, 'contact_email_value', $lang)) ?>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h3><?= e(site_text($pdo, 'contact_phone_label', $lang)) ?></h3>
                        <p><a href="tel:+96171212368">+961 71 212 368</a></p>
                        <p><a href="tel:+96125432522">+961 25 432 522</a></p>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div>
                        <h3><?= e(site_text($pdo, 'contact_location_label', $lang)) ?></h3>

                        <?php if (!empty($offices)): ?>
                            <div class="contact-office-list">
                                <?php foreach ($offices as $office): ?>
                                    <div class="contact-office-item">
                                        <strong><?= e($office['office_name']) ?></strong><br>

                                        <?= e(
                                            trim(
                                                ($office['city'] ?? '') .
                                                (!empty($office['city']) && !empty($office['country']) ? ', ' : '') .
                                                ($office['country'] ?? '')
                                            )
                                        ) ?>

                                        <?php if (!empty($office['address_text'])): ?>
                                            <br>
                                            <span class="contact-office-address">
                                                <?= e($office['address_text']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p><?= e(site_text($pdo, 'contact_location_value', $lang)) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrap">
                <?php
                    $contactSuccess = isset($_GET['contact']) && $_GET['contact'] === 'success';
                    $contactError = isset($_GET['contact']) && $_GET['contact'] === 'error';
                ?>

                <?php if ($contactSuccess): ?>
                    <div class="contact-alert success">
                        <?= e(site_text($pdo, 'contact_success', $lang)) ?>
                    </div>
                <?php endif; ?>

                <?php if ($contactError): ?>
                    <div class="contact-alert error">
                        <?= e(site_text($pdo, 'contact_error', $lang)) ?>
                    </div>
                <?php endif; ?>

                <form class="contact-form" action="/contact-submit.php" method="POST">
                    <input type="hidden" name="lang" value="<?= e($lang) ?>">
                    <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
                    <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                    <div class="form-group">
                        <label for="contact_name"><?= e(site_text($pdo, 'contact_name_label', $lang)) ?></label>
                        <input
                            type="text"
                            id="contact_name"
                            name="name"
                            placeholder="<?= e(site_text($pdo, 'contact_name_placeholder', $lang)) ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="contact_email"><?= e(site_text($pdo, 'contact_email_field_label', $lang)) ?></label>
                        <input
                            type="email"
                            id="contact_email"
                            name="email"
                            placeholder="<?= e(site_text($pdo, 'contact_email_placeholder', $lang)) ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="contact_message"><?= e(site_text($pdo, 'contact_message_label', $lang)) ?></label>
                        <textarea
                            id="contact_message"
                            name="message"
                            rows="6"
                            placeholder="<?= e(site_text($pdo, 'contact_message_placeholder', $lang)) ?>"
                            required
                        ></textarea>
                    </div>

                    <button type="submit" class="btn-primary contact-submit-btn">
                        <?= e(site_text($pdo, 'contact_submit', $lang)) ?>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>
<?php require __DIR__ . '/partials/footer.php'; ?>