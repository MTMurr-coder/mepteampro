(function () {
    const storageKey = "mepteampro-theme";
    const body = document.body;
    const themeToggle = document.getElementById("theme-toggle");
    const menuToggle = document.getElementById("menu-toggle");
    const mobilePanel = document.getElementById("mobile-panel");

    function applyTheme(theme) {
        const isDark = theme === "dark";
        body.classList.toggle("dark", isDark);

        if (themeToggle) {
            const iconEl  = themeToggle.querySelector(".theme-toggle-icon");
            const labelEl = themeToggle.querySelector(".theme-toggle-label");
            const lang    = document.documentElement.lang || "en";

            if (iconEl) {
                // Update only the icon span — never overwrite the whole button
                iconEl.textContent = isDark ? "☀" : "🌙";
            } else {
                // Fallback: no span structure, safe to set textContent directly
                themeToggle.textContent = isDark ? "☀" : "🌙";
            }

            if (labelEl) {
                if (isDark) {
                    labelEl.textContent = lang === "fr" ? "Clair" : (lang === "ar" ? "فاتح" : "Light");
                } else {
                    labelEl.textContent = lang === "fr" ? "Sombre" : (lang === "ar" ? "داكن" : "Dark");
                }
            }

            themeToggle.setAttribute(
                "aria-label",
                isDark ? "Switch to light mode" : "Switch to dark mode"
            );
        }
    }

    const savedTheme = localStorage.getItem(storageKey) || "light";
    applyTheme(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener("click", function () {
            const nextTheme = body.classList.contains("dark") ? "light" : "dark";
            localStorage.setItem(storageKey, nextTheme);
            applyTheme(nextTheme);
        });
    }

    window.addEventListener("scroll", function () {
        body.classList.toggle("scrolled", window.scrollY > 50);
    });

    if (menuToggle && mobilePanel) {
        menuToggle.addEventListener("click", function () {
            const isOpen = mobilePanel.classList.toggle("open");
            menuToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
            menuToggle.textContent = isOpen ? "✕" : "☰";
        });

        mobilePanel.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
                mobilePanel.classList.remove("open");
                menuToggle.setAttribute("aria-expanded", "false");
                menuToggle.textContent = "☰";
            });
        });
    }
})();