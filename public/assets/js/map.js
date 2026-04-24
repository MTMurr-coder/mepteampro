document.addEventListener('DOMContentLoaded', function () {
    const mapEl = document.getElementById('projects-map');
    if (!mapEl || typeof L === 'undefined') return;

    const rawProjects = Array.isArray(window.projectLocations) ? window.projectLocations : [];
    const rawOffices = Array.isArray(window.offices) ? window.offices : [];
    const lang = document.documentElement.lang || 'en';
    const dir = document.documentElement.dir || 'ltr';
    const t = Object.assign({
        office: lang === 'fr' ? 'Bureau' : (lang === 'ar' ? 'مكتب' : 'Office'),
        project: lang === 'fr' ? 'Projet' : (lang === 'ar' ? 'مشروع' : 'Project')
    }, window.mapTranslations || {});

    const pickLocalized = (item, baseKey) => {
        if (!item || typeof item !== 'object') return '';
        const localizedKey = `${baseKey}_${lang}`;
        const fallbackKeys = [localizedKey, baseKey, `${baseKey}_en`, `${baseKey}_fr`, `${baseKey}_ar`];
        for (const key of fallbackKeys) {
            const value = item[key];
            if (typeof value === 'string' && value.trim() !== '') return value.trim();
        }
        return '';
    };

    const normalizeProject = (project) => ({
        latitude: project.latitude,
        longitude: project.longitude,
        title: pickLocalized(project, 'title'),
        city: pickLocalized(project, 'city'),
        country: pickLocalized(project, 'country')
    });

    const normalizeOffice = (office) => ({
        latitude: office.latitude,
        longitude: office.longitude,
        office_name: pickLocalized(office, 'office_name'),
        city: pickLocalized(office, 'city'),
        country: pickLocalized(office, 'country'),
        address_text: pickLocalized(office, 'address_text')
    });

    const projectLocations = rawProjects.map(normalizeProject);
    const offices = rawOffices.map(normalizeOffice);

    const escapeHtml = (value) => String(value || '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');

    const map = L.map('projects-map', {
        zoomControl: false,
        attributionControl: true,
        dragging: false,
        scrollWheelZoom: false,
        doubleClickZoom: false,
        boxZoom: false,
        keyboard: false,
        touchZoom: false,
        tap: false,
        zoomAnimation: false,
        fadeAnimation: false,
        markerZoomAnimation: false,
        inertia: false
    });

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        subdomains: 'abcd',
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap &copy; CARTO'
    }).addTo(map);

    const bounds = [];

    const projectIcon = L.divIcon({
        className: 'custom-map-icon',
        html: '<div class="project-marker"></div>',
        iconSize: [14, 14],
        iconAnchor: [7, 7]
    });

    const officeIcon = L.divIcon({
        className: 'custom-map-icon',
        html: `
            <div class="office-marker-wrap">
                <div class="office-marker-pulse"></div>
                <div class="office-marker-core"></div>
            </div>
        `,
        iconSize: [28, 28],
        iconAnchor: [14, 22],
        popupAnchor: [0, -18]
    });

    const popupHtml = ({ typeClass, typeLabel, title, lines }) => `
        <div class="map-popup" dir="${escapeHtml(dir)}">
            <span class="map-popup-type ${escapeHtml(typeClass)}">${escapeHtml(typeLabel)}</span>
            <p class="map-popup-title">${escapeHtml(title)}</p>
            ${lines.filter(Boolean).map(line => `<p class="map-popup-text">${escapeHtml(line)}</p>`).join('')}
        </div>
    `;

    projectLocations.forEach((project) => {
        const lat = parseFloat(project.latitude);
        const lng = parseFloat(project.longitude);
        if (Number.isNaN(lat) || Number.isNaN(lng)) return;

        bounds.push([lat, lng]);
        const locationText = [project.city, project.country].filter(Boolean).join(', ');

        L.marker([lat, lng], { icon: projectIcon })
            .addTo(map)
            .bindPopup(popupHtml({
                typeClass: 'project',
                typeLabel: t.project,
                title: project.title || t.project,
                lines: [locationText]
            }));
    });

    offices.forEach((office) => {
        const lat = parseFloat(office.latitude);
        const lng = parseFloat(office.longitude);
        if (Number.isNaN(lat) || Number.isNaN(lng)) return;

        bounds.push([lat, lng]);
        const locationText = [office.city, office.country].filter(Boolean).join(', ');

        L.marker([lat, lng], { icon: officeIcon })
            .addTo(map)
            .bindPopup(popupHtml({
                typeClass: 'office',
                typeLabel: t.office,
                title: office.office_name || t.office,
                lines: [locationText, office.address_text]
            }));
    });

    function fitMapProperly() {
        map.invalidateSize();

        if (bounds.length > 1) {
            map.fitBounds(L.latLngBounds(bounds), {
                padding: window.innerWidth <= 640 ? [60, 60] : [40, 40],
                maxZoom: window.innerWidth <= 640 ? 1.8 : 3
            });
        } else if (bounds.length === 1) {
            map.setView(bounds[0], window.innerWidth <= 640 ? 2 : 4);
        } else {
            map.setView([20, 0], window.innerWidth <= 640 ? 1.3 : 1.6);
        }
    }

    fitMapProperly();
    setTimeout(fitMapProperly, 200);
    setTimeout(fitMapProperly, 600);
    window.addEventListener('resize', fitMapProperly);
    window.addEventListener('orientationchange', fitMapProperly);
});
