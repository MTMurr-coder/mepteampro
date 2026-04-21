<?php require __DIR__ . '/partials/header.php'; ?>

<main>
<section class="hero-v2">
    <div class="container">
        <div class="hero-inner">

            <div class="hero-left">

                <h1><?= e(site_text($pdo, 'hero_main_title', $lang)) ?></h1>

                <p class="hero-sub">
                    <?= e(site_text($pdo, 'hero_subtitle', $lang)) ?>
                </p>

                <div class="hero-actions">
                    <a href="#services" class="btn-primary">
                        <?= e(site_text($pdo, 'hero_btn_primary', $lang)) ?>
                    </a>

                    <a href="#projects" class="btn-secondary">
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

        <h2 class="section-title">
            <?= e(site_text($pdo, 'about_title', $lang)) ?>
        </h2>

        <?php $aboutIntro = site_text($pdo, 'about_intro', $lang); ?>
        <?php if (!empty($aboutIntro)): ?>
            <p class="section-lead">
                <?= e($aboutIntro) ?>
            </p>
        <?php endif; ?>

        <div class="about-shell">

            <!-- LEFT -->
            <div class="about-left">

                <div class="about-image-wrap">
                    <img src="assets/images/about.jpg"
                         alt="<?= e(site_text($pdo, 'about_title', $lang)) ?>">
                </div>

                <div class="about-info-card">
                    <h3><?= e(site_text($pdo, 'about_vision_title', $lang)) ?></h3>
                    <p><?= e(site_text($pdo, 'about_vision_text', $lang)) ?></p>
                </div>

                <div class="about-info-card">
                    <h3><?= e(site_text($pdo, 'about_mission_title', $lang)) ?></h3>
                    <p><?= e(site_text($pdo, 'about_mission_text', $lang)) ?></p>
                </div>

                <div class="about-info-card">
                    <h3><?= e(site_text($pdo, 'about_aim_title', $lang)) ?></h3>
                    <p><?= e(site_text($pdo, 'about_aim_text', $lang)) ?></p>
                </div>

                <div class="about-summary">
                    <p><?= e(site_text($pdo, 'about_highlight_text', $lang)) ?></p>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="about-right">

                <h3 class="about-beliefs-title">
                    <?= e(site_text($pdo, 'about_beliefs_title', $lang)) ?>
                </h3>

                <div class="about-beliefs-grid">

                    <div class="about-belief-card">
                        <div class="about-belief-icon">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h4><?= e(site_text($pdo, 'about_belief_1_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_1_text', $lang)) ?></p>
                    </div>

                    <div class="about-belief-card">
                        <div class="about-belief-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h4><?= e(site_text($pdo, 'about_belief_2_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_2_text', $lang)) ?></p>
                    </div>

                    <div class="about-belief-card">
                        <div class="about-belief-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h4><?= e(site_text($pdo, 'about_belief_3_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_3_text', $lang)) ?></p>
                    </div>

                    <div class="about-belief-card">
                        <div class="about-belief-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <h4><?= e(site_text($pdo, 'about_belief_4_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_4_text', $lang)) ?></p>
                    </div>

                    <div class="about-belief-card">
                        <div class="about-belief-icon">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <h4><?= e(site_text($pdo, 'about_belief_5_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_5_text', $lang)) ?></p>
                    </div>

                    <div class="about-belief-card">
                        <div class="about-belief-icon">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <h4><?= e(site_text($pdo, 'about_belief_6_title', $lang)) ?></h4>
                        <p><?= e(site_text($pdo, 'about_belief_6_text', $lang)) ?></p>
                    </div>

                </div>

                <div class="about-advantages">
                    <h3><?= e(site_text($pdo, 'about_advantages_title', $lang)) ?></h3>
                    <ul>
                        <li><?= e(site_text($pdo, 'about_advantage_1', $lang)) ?></li>
                        <li><?= e(site_text($pdo, 'about_advantage_2', $lang)) ?></li>
                        <li><?= e(site_text($pdo, 'about_advantage_3', $lang)) ?></li>
                        <li><?= e(site_text($pdo, 'about_advantage_4', $lang)) ?></li>
                        <li><?= e(site_text($pdo, 'about_advantage_5', $lang)) ?></li>
                        <li><?= e(site_text($pdo, 'about_advantage_6', $lang)) ?></li>
                    </ul>
                </div>

            </div>

        </div>
    </div>
</section>
 <section class="services-section section" id="services">
    <div class="container">

        <h2 class="section-title">
            <?= e(site_text($pdo, 'services_title', $lang)) ?>
        </h2>

        <?php $servicesIntro = site_text($pdo, 'services_intro', $lang); ?>
        <?php if (!empty($servicesIntro)): ?>
            <p class="section-lead">
                <?= e($servicesIntro) ?>
            </p>
        <?php endif; ?>

        <div class="services-grid services-grid-figma">

            <article class="service-card service-card-mechanical">
                <div class="service-icon">
                    <i class="fa-solid fa-gear"></i>
                </div>
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

            <article class="service-card service-card-hvac">
                <div class="service-icon">
                    <i class="fa-solid fa-wind"></i>
                </div>
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

            <article class="service-card service-card-fire">
                <div class="service-icon">
                    <i class="fa-solid fa-fire-flame-simple"></i>
                </div>
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

            <article class="service-card service-card-electrical">
                <div class="service-icon">
                    <i class="fa-solid fa-bolt"></i>
                </div>
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

            <article class="service-card service-card-plumbing">
                <div class="service-icon">
                    <i class="fa-solid fa-droplet"></i>
                </div>
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

            <article class="service-card service-card-elv">
                <div class="service-icon">
                    <i class="fa-solid fa-camera"></i>
                </div>
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

            <article class="service-card service-card-water">
                <div class="service-icon">
                    <i class="fa-solid fa-water"></i>
                </div>
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
    ?>

    <div class="projects-filter-wrap">
        <!-- Desktop tabs -->
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

        <!-- Mobile dropdown -->
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

    <div class="portfolio-slider" id="portfolioSlider">
        <?php foreach ($projects as $index => $project): ?>
            <?php
                $country = trim((string)($project['country'] ?? ''));
                $locationLabel = trim(
                    ($project['city'] ?? '') .
                    (!empty($project['city']) && !empty($project['country']) ? ', ' : '') .
                    ($project['country'] ?? '')
                );
            ?>
            <div
                class="portfolio-slide <?= $index === 0 ? 'active' : '' ?>"
                data-country="<?= e($country) ?>"
            >
                <div class="portfolio-image">
                    <img src="<?= e($project['img_url']) ?>" alt="<?= e($project['title']) ?>">
                </div>

                <div class="portfolio-content">
                    <div class="portfolio-count">
                        <span class="portfolioCurrent">1</span>
                        <span class="portfolio-count-separator">/</span>
                        <span class="portfolioTotal"><?= count($projects) ?></span>
                    </div>

                    <h3><?= e($project['title']) ?></h3>

                    <p class="portfolio-desc">
                        <?= e($project['description']) ?>
                    </p>

                    <?php if (!empty($project['area'])): ?>
                        <div class="portfolio-meta">
                            <strong><?= e(site_text($pdo, 'projects_area_label', $lang)) ?>:</strong>
                            <span><?= e($project['area']) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($locationLabel !== ''): ?>
                        <div class="portfolio-location">
                            <i class="fas fa-location-dot"></i>
                            <span><?= e($locationLabel) ?></span>
                        </div>
                    <?php endif; ?>
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
<?php endif; ?>
    </div>
</section>
<section class="map-showcase section" id="locations">
    <div class="container">
        <div class="projects-heading">
            <h2 class="section-title">
                <?= e(site_text($pdo, 'map_title', $lang)) ?>
            </h2>

            <p class="section-lead">
                <?= e(site_text($pdo, 'map_intro', $lang)) ?>
            </p>
        </div>

        <div class="map-card">
            <div id="projects-map"></div>
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