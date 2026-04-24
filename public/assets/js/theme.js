(function () {
    const storageKey = 'mepteampro-theme';
    const body = document.body;
    const themeToggle = document.getElementById('theme-toggle');
    const menuToggle = document.getElementById('menu-toggle');
    const mobilePanel = document.getElementById('mobile-panel');

    function currentLabels(isDark) {
        const lang = document.documentElement.lang || 'en';
        return {
            dark: lang === 'fr' ? 'Sombre' : (lang === 'ar' ? 'داكن' : 'Dark'),
            light: lang === 'fr' ? 'Clair' : (lang === 'ar' ? 'فاتح' : 'Light'),
            toDark: lang === 'fr' ? 'Activer le mode sombre' : (lang === 'ar' ? 'التبديل إلى الوضع الداكن' : 'Switch to dark mode'),
            toLight: lang === 'fr' ? 'Activer le mode clair' : (lang === 'ar' ? 'التبديل إلى الوضع الفاتح' : 'Switch to light mode')
        };
    }

    function applyTheme(theme) {
        const isDark = theme === 'dark';
        const labels = currentLabels(isDark);
        body.classList.toggle('dark', isDark);

        if (themeToggle) {
            const iconEl = themeToggle.querySelector('.theme-toggle-icon');
            const labelEl = themeToggle.querySelector('.theme-toggle-label');
            if (iconEl) iconEl.textContent = isDark ? '☀' : '🌙';
            if (labelEl) labelEl.textContent = isDark ? labels.light : labels.dark;
            themeToggle.setAttribute('aria-label', isDark ? labels.toLight : labels.toDark);
            themeToggle.setAttribute('title', isDark ? labels.toLight : labels.toDark);
        }
    }

    function closeMobileMenu() {
        if (!mobilePanel || !menuToggle) return;
        mobilePanel.classList.remove('open');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.textContent = '☰';
        body.classList.remove('menu-open');
    }

    function openMobileMenu() {
        if (!mobilePanel || !menuToggle) return;
        mobilePanel.classList.add('open');
        menuToggle.setAttribute('aria-expanded', 'true');
        menuToggle.textContent = '✕';
        body.classList.add('menu-open');
    }

    const savedTheme = localStorage.getItem(storageKey) || 'light';
    applyTheme(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            const nextTheme = body.classList.contains('dark') ? 'light' : 'dark';
            localStorage.setItem(storageKey, nextTheme);
            applyTheme(nextTheme);
        });
    }

    window.addEventListener('scroll', function () {
        body.classList.toggle('scrolled', window.scrollY > 20);
    });
    body.classList.toggle('scrolled', window.scrollY > 20);

    if (menuToggle && mobilePanel) {
        menuToggle.addEventListener('click', function () {
            const isOpen = mobilePanel.classList.contains('open');
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        mobilePanel.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMobileMenu);
        });

        document.addEventListener('click', function (event) {
            if (!mobilePanel.contains(event.target) && !menuToggle.contains(event.target)) {
                closeMobileMenu();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeMobileMenu();
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 992) closeMobileMenu();
        });
    }
})();
