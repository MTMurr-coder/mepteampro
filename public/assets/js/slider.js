document.addEventListener('DOMContentLoaded', () => {
    const slider = document.getElementById('portfolioSlider');
    if (!slider) return;

    const allSlides = Array.from(slider.querySelectorAll('.portfolio-slide'));
    const nextBtn = slider.querySelector('.portfolio-nav.next');
    const prevBtn = slider.querySelector('.portfolio-nav.prev');
    const desktopTabs = Array.from(document.querySelectorAll('.project-country-tab'));
    const mobileItems = Array.from(document.querySelectorAll('.projects-mobile-filter-item'));
    const mobileToggle = document.getElementById('projectsMobileFilterToggle');
    const mobileMenu = document.getElementById('projectsMobileFilterMenu');
    const mobileToggleText = mobileToggle ? mobileToggle.querySelector('span') : null;
    const isRTL = document.documentElement.getAttribute('dir') === 'rtl';

    let visibleSlides = [...allSlides];
    let current = 0;
    let activeCountry = 'all';

    const normalize = (value) => String(value || '').trim().toLowerCase();

    const updateCounter = () => {
        visibleSlides.forEach((slide, index) => {
            const currentEl = slide.querySelector('.portfolioCurrent');
            const totalEl = slide.querySelector('.portfolioTotal');
            if (currentEl) currentEl.textContent = String(index + 1);
            if (totalEl) totalEl.textContent = String(visibleSlides.length);
        });
    };

    const updateProgressBar = (slide) => {
        const fill = slide.querySelector('.portfolio-progress-fill');
        if (!fill) return;
        fill.style.transition = 'none';
        fill.style.width = '0%';
        requestAnimationFrame(() => {
            fill.style.transition = 'width 0.3s ease';
            fill.style.width = visibleSlides.length > 1
                ? `${((visibleSlides.indexOf(slide) + 1) / visibleSlides.length) * 100}%`
                : '100%';
        });
    };

    const showSlide = (index) => {
        allSlides.forEach((slide) => slide.classList.remove('active'));
        if (!visibleSlides.length) return;
        current = (index + visibleSlides.length) % visibleSlides.length;
        visibleSlides[current].classList.add('active');
        updateCounter();
        updateProgressBar(visibleSlides[current]);
    };

    const updateMobileToggleLabel = () => {
        if (!mobileToggleText) return;
        const activeLabel = [...mobileItems, ...desktopTabs].find(
            (item) => normalize(item.dataset.country || 'all') === normalize(activeCountry)
        );
        if (activeLabel) mobileToggleText.textContent = activeLabel.textContent.trim();
    };

    const syncActiveControls = () => {
        desktopTabs.forEach((tab) => {
            tab.classList.toggle('active', normalize(tab.dataset.country || 'all') === normalize(activeCountry));
        });
        mobileItems.forEach((item) => {
            item.classList.toggle('active', normalize(item.dataset.country || 'all') === normalize(activeCountry));
        });
        updateMobileToggleLabel();
    };

    const applyFilter = () => {
        visibleSlides = allSlides.filter((slide) => {
            const slideCountry = normalize(slide.dataset.country || '');
            return normalize(activeCountry) === 'all' || slideCountry === normalize(activeCountry);
        });

        allSlides.forEach((slide) => slide.classList.remove('active'));
        if (visibleSlides.length) {
            current = 0;
            visibleSlides[0].classList.add('active');
            updateCounter();
            updateProgressBar(visibleSlides[0]);
        }
        syncActiveControls();
    };

    desktopTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            activeCountry = tab.dataset.country || 'all';
            applyFilter();
        });
    });

    mobileItems.forEach((item) => {
        item.addEventListener('click', () => {
            activeCountry = item.dataset.country || 'all';
            applyFilter();
            if (mobileMenu) mobileMenu.classList.remove('open');
            if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'false');
        });
    });

    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('open');
            mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    document.addEventListener('click', (event) => {
        const filter = document.getElementById('projectsMobileFilter');
        if (!filter || !mobileMenu || !mobileToggle) return;
        if (!filter.contains(event.target)) {
            mobileMenu.classList.remove('open');
            mobileToggle.setAttribute('aria-expanded', 'false');
        }
    });

    nextBtn && nextBtn.addEventListener('click', () => {
        if (!visibleSlides.length) return;
        showSlide(isRTL ? current - 1 : current + 1);
    });

    prevBtn && prevBtn.addEventListener('click', () => {
        if (!visibleSlides.length) return;
        showSlide(isRTL ? current + 1 : current - 1);
    });

    slider.addEventListener('keydown', (e) => {
        if (!visibleSlides.length) return;
        if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
            e.preventDefault();
            showSlide(isRTL ? current - 1 : current + 1);
        } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
            e.preventDefault();
            showSlide(isRTL ? current + 1 : current - 1);
        }
    });

    applyFilter();
});
