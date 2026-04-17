<?php require __DIR__ . '/partials/header.php'; ?>

<main>
    <section class="hero-v2">
        <div class="container hero-inner">
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
 <section id="services" class="services-section">
    <div class="container">
        <div class="services-heading">
            <span class="section-kicker">
                <?= e(site_text($pdo, 'services_kicker', $lang)) ?>
            </span>

            <h2 class="section-title">
                <?= e(site_text($pdo, 'services_section_title', $lang)) ?>
            </h2>

            <p class="section-text">
                <?= e(site_text($pdo, 'services_section_text', $lang)) ?>
            </p>
        </div>

        <div class="services-grid">
            <?php foreach ($services as $index => $service): ?>
                <article class="service-card">
                    <div class="service-icon">
                        <?php if ($index % 3 === 0): ?>
                            ⚡
                        <?php elseif ($index % 3 === 1): ?>
                            💧
                        <?php else: ?>
                            ❄
                        <?php endif; ?>
                    </div>

                    <h3><?= e($service['title']) ?></h3>
                    <p><?= e($service['description']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

    <section id="projects" class="section section-placeholder">
        <div class="container">
            <h2><?= e(site_text($pdo, 'projects_section_title', $lang)) ?></h2>
            <p class="section-lead"><?= e(site_text($pdo, 'projects_section_text', $lang)) ?></p>

            <div class="card-grid">
                <?php foreach ($projects as $project): ?>
                    <article class="card">
                        <?php if (!empty($project['img_url'])): ?>
                            <img
                                class="project-image"
                                src="<?= e($project['img_url']) ?>"
                                alt="<?= e($project['title']) ?>"
                            >
                        <?php endif; ?>

                        <h3><?= e($project['title']) ?></h3>
                        <p><?= e($project['description']) ?></p>

                        <?php if (!empty($project['city']) || !empty($project['country'])): ?>
                            <p class="project-location">
                                <?= e(trim(
                                    ($project['city'] ?? '') .
                                    (!empty($project['city']) && !empty($project['country']) ? ', ' : '') .
                                    ($project['country'] ?? '')
                                )) ?>
                            </p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="contact" class="section section-placeholder">
        <div class="container">
            <h2><?= e(site_text($pdo, 'contact_section_title', $lang)) ?></h2>
            <p><?= e(site_text($pdo, 'contact_section_text', $lang)) ?></p>
        </div>
    </section>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>