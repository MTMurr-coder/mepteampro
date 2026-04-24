<footer class="site-footer footer-v2">
    <div class="container">
        <div class="footer-top">

            <div class="footer-col footer-brand">
                <h3><?= e(site_text($pdo, 'footer_company_title', $lang)) ?></h3>

                <p class="footer-brand-text">
                    <?= e(site_text($pdo, 'footer_company_intro', $lang)) ?>
                </p>

                <div class="footer-contact-list">
                    <?php
                        $rawPhone = trim((string) site_text($pdo, 'contact_phone_value', $lang));
                        $phoneParts = preg_split('/\r\n|\r|\n|\/|,/', $rawPhone) ?: [];
                    ?>
                    <?php foreach ($phoneParts as $phoneItem): ?>
                        <?php $phoneItem = trim($phoneItem); ?>
                        <?php if ($phoneItem !== ''): ?>
                            <div class="footer-contact-item">
                                <i class="fas fa-phone"></i>
                                <a href="tel:<?= preg_replace('/[^\d+]/', '', $phoneItem) ?>">
                                    <?= e($phoneItem) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php $email = trim((string) site_text($pdo, 'contact_email_value', $lang)); ?>
                    <?php if ($email !== ''): ?>
                        <div class="footer-contact-item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?= e($email) ?>"><?= e($email) ?></a>
                        </div>
                    <?php endif; ?>
                </div>

                <a href="#contact" class="footer-cta">
                    <?= e(site_text($pdo, 'contact_submit', $lang)) ?>
                </a>
            </div>

            <div class="footer-col">
                <h4><?= e(site_text($pdo, 'footer_quick_links_title', $lang)) ?></h4>
                <ul class="footer-links">
                    <li><a href="#about"><?= e(site_text($pdo, 'nav_about', $lang)) ?></a></li>
                    <li><a href="#services"><?= e(site_text($pdo, 'nav_services', $lang)) ?></a></li>
                    <li><a href="#projects"><?= e(site_text($pdo, 'nav_projects', $lang)) ?></a></li>
                    <li><a href="#locations"><?= e(site_text($pdo, 'map_title', $lang)) ?></a></li>
                    <li><a href="#contact"><?= e(site_text($pdo, 'nav_contact', $lang)) ?></a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4><?= e(site_text($pdo, 'footer_services_title', $lang)) ?></h4>
                <?php
                    $footerServiceSlugs = [
                        'mechanical'      => 'service_1_title',
                        'hvac'            => 'service_2_title',
                        'fire-protection' => 'service_3_title',
                        'electrical'      => 'service_4_title',
                        'plumbing'        => 'service_5_title',
                        'elv'             => 'service_6_title',
                        'water-steel'     => 'service_7_title',
                    ];
                ?>
                <ul class="footer-links">
                    <?php foreach ($footerServiceSlugs as $slug => $key): ?>
                        <li>
                            <a href="?page=service-details&slug=<?= urlencode($slug) ?>&lang=<?= urlencode($lang) ?>">
                                <?= e(site_text($pdo, $key, $lang)) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="footer-col">
                <h4><?= e(site_text($pdo, 'footer_certifications_title', $lang)) ?></h4>

                <div class="footer-badges">
                    <span class="footer-badge"><?= e(site_text($pdo, 'footer_badge_1', $lang)) ?></span>
                    <span class="footer-badge"><?= e(site_text($pdo, 'footer_badge_2', $lang)) ?></span>
                    <span class="footer-badge footer-badge-wide"><?= e(site_text($pdo, 'footer_badge_3', $lang)) ?></span>
                </div>

                <h4 class="footer-follow-title"><?= e(site_text($pdo, 'footer_follow_title', $lang)) ?></h4>

                <div class="footer-socials">
                    <a
                        href="<?= e(site_text($pdo, 'footer_linkedin_url', $lang)) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="LinkedIn"
                    >
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="footer-divider"></div>

        <div class="footer-bottom">
            <p class="footer-copy">
                &copy; <?= date('Y') ?> <?= e(site_text($pdo, 'site_title', $lang)) ?>.
                <?= e(site_text($pdo, 'footer_text', $lang)) ?>
            </p>
        </div>
    </div>
</footer>

<script>
    window.projectLocations = <?= json_encode($projectLocations ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
    window.offices = <?= json_encode($offices ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="/assets/js/theme.js"></script>
<script src="/assets/js/map.js"></script>
<script src="/assets/js/slider.js"></script>
</body>
</html>