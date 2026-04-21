<footer class="site-footer footer-v2">
    <div class="container">
        <div class="footer-top">
            <div class="footer-col footer-brand">
                <h3><?= e(site_text($pdo, 'footer_company_title', $lang)) ?></h3>

                <p class="footer-brand-text">
                    <?= e(site_text($pdo, 'footer_company_intro', $lang)) ?>
                </p>

                <div class="footer-contact-list">
                    <div class="footer-contact-item">
                        <i class="fas fa-phone"></i>
                        <a href="tel:+96171212368"><?= e(site_text($pdo, 'contact_phone_value', $lang)) ?></a>
                    </div>

                    <div class="footer-contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:<?= e(site_text($pdo, 'contact_email_value', $lang)) ?>">
                            <?= e(site_text($pdo, 'contact_email_value', $lang)) ?>
                        </a>
                    </div>
                </div>
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
                <ul class="footer-links">
                    <li><?= e(site_text($pdo, 'service_1_title', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_2_title', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_3_title', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_4_title', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_5_title', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_6_title', $lang)) ?></li>
                    <li><?= e(site_text($pdo, 'service_7_title', $lang)) ?></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4><?= e(site_text($pdo, 'footer_certifications_title', $lang)) ?></h4>

                <div class="footer-badges">
                    <span class="footer-badge"><?= e(site_text($pdo, 'footer_badge_1', $lang)) ?></span>
                    <span class="footer-badge"><?= e(site_text($pdo, 'footer_badge_2', $lang)) ?></span>
                    <span class="footer-badge"><?= e(site_text($pdo, 'footer_badge_3', $lang)) ?></span>
                </div>

                <h4 class="footer-follow-title"><?= e(site_text($pdo, 'footer_follow_title', $lang)) ?></h4>

                <div class="footer-socials">
                    <a href="<?= e(site_text($pdo, 'footer_linkedin_url', $lang)) ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                  <!--  <a href="<?= e(site_text($pdo, 'footer_instagram_url', $lang)) ?>" target="_blank" rel="noopener" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="<?= e(site_text($pdo, 'footer_x_url', $lang)) ?>" target="_blank" rel="noopener" aria-label="X">
                        <i class="fab fa-x-twitter"></i>
                    </a>-->
                </div>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="footer-bottom">
            <p class="footer-copy">
                © <?= date('Y') ?> <?= e(site_text($pdo, 'site_title', $lang)) ?>.
                <?= e(site_text($pdo, 'footer_text', $lang)) ?>
            </p>

            <div class="footer-bottom-links">
            <!--  <a href="#"><?= e(site_text($pdo, 'footer_privacy', $lang)) ?></a>
                <a href="#"><?= e(site_text($pdo, 'footer_terms', $lang)) ?></a>
                <a href="#contact"><?= e(site_text($pdo, 'footer_careers', $lang)) ?></a>-->
            </div>
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

<script>
document.addEventListener("DOMContentLoaded", () => {
    const slider = document.getElementById("portfolioSlider");
    if (!slider) return;

    const allSlides = Array.from(slider.querySelectorAll(".portfolio-slide"));
    const nextBtn = slider.querySelector(".portfolio-nav.next");
    const prevBtn = slider.querySelector(".portfolio-nav.prev");

    const desktopTabs = Array.from(document.querySelectorAll(".project-country-tab"));
    const mobileItems = Array.from(document.querySelectorAll(".projects-mobile-filter-item"));

    const mobileToggle = document.getElementById("projectsMobileFilterToggle");
    const mobileMenu = document.getElementById("projectsMobileFilterMenu");
    const mobileToggleText = mobileToggle?.querySelector("span");

    const isRTL = document.documentElement.getAttribute("dir") === "rtl";

    let visibleSlides = [...allSlides];
    let current = 0;
    let activeCountry = "all";

    const updateCounter = () => {
        visibleSlides.forEach((slide, index) => {
            const currentEl = slide.querySelector(".portfolioCurrent");
            const totalEl = slide.querySelector(".portfolioTotal");
            if (currentEl) currentEl.textContent = String(index + 1);
            if (totalEl) totalEl.textContent = String(visibleSlides.length);
        });
    };

    const showSlide = (index) => {
        allSlides.forEach(slide => slide.classList.remove("active"));
        if (!visibleSlides.length) return;

        current = (index + visibleSlides.length) % visibleSlides.length;
        visibleSlides[current].classList.add("active");
        updateCounter();
    };

    const updateMobileToggleLabel = () => {
        if (!mobileToggleText) return;

        const activeMobileItem = mobileItems.find(
            item => (item.dataset.country || "all") === activeCountry
        );

        if (activeMobileItem) {
            mobileToggleText.textContent = activeMobileItem.textContent.trim();
        }
    };

    const syncActiveControls = () => {
        desktopTabs.forEach(tab => {
            tab.classList.toggle("active", (tab.dataset.country || "all") === activeCountry);
        });

        mobileItems.forEach(item => {
            item.classList.toggle("active", (item.dataset.country || "all") === activeCountry);
        });

        updateMobileToggleLabel();
    };

    const applyFilter = () => {
        visibleSlides = allSlides.filter(slide => {
            if (activeCountry === "all") return true;
            return slide.dataset.country === activeCountry;
        });

        allSlides.forEach(slide => slide.classList.remove("active"));

        if (visibleSlides.length) {
            current = 0;
            visibleSlides[0].classList.add("active");
            updateCounter();
        }

        syncActiveControls();
    };

    desktopTabs.forEach(tab => {
        tab.addEventListener("click", () => {
            activeCountry = tab.dataset.country || "all";
            applyFilter();
        });
    });

    mobileItems.forEach(item => {
        item.addEventListener("click", () => {
            activeCountry = item.dataset.country || "all";
            applyFilter();
            mobileMenu?.classList.remove("open");
        });
    });

    mobileToggle?.addEventListener("click", () => {
        mobileMenu?.classList.toggle("open");
    });

    document.addEventListener("click", (event) => {
        const filter = document.getElementById("projectsMobileFilter");
        if (!filter) return;
        if (!filter.contains(event.target)) {
            mobileMenu?.classList.remove("open");
        }
    });

    nextBtn?.addEventListener("click", () => {
        if (!visibleSlides.length) return;
        if (isRTL) {
            showSlide(current - 1);
        } else {
            showSlide(current + 1);
        }
    });

    prevBtn?.addEventListener("click", () => {
        if (!visibleSlides.length) return;
        if (isRTL) {
            showSlide(current + 1);
        } else {
            showSlide(current - 1);
        }
    });

    applyFilter();
});
</script>
</body>
</html>