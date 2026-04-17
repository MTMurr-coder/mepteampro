(function () {
    const storageKey = "mepteampro-theme";
    const body = document.body;
    const themeToggle = document.getElementById("theme-toggle");
    const menuToggle = document.getElementById("menu-toggle");
    const mobilePanel = document.getElementById("mobile-panel");

    function applyTheme(theme) {
        if (theme === "dark") {
            body.classList.add("dark");
            if (themeToggle) themeToggle.textContent = "☀";
        } else {
            body.classList.remove("dark");
            if (themeToggle) themeToggle.textContent = "🌙";
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
        if (window.scrollY > 50) {
            document.body.classList.add("scrolled");
        } else {
            document.body.classList.remove("scrolled");
        }
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