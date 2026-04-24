document.addEventListener("DOMContentLoaded", function () {
    const mapEl = document.getElementById("projects-map");
    if (!mapEl || typeof L === "undefined") return;

    const projectLocations = Array.isArray(window.projectLocations) ? window.projectLocations : [];
    const offices = Array.isArray(window.offices) ? window.offices : [];

    const map = L.map("projects-map", {
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

    L.tileLayer("https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png", {
        subdomains: "abcd",
        maxZoom: 19,
        attribution: "&copy; OpenStreetMap &copy; CARTO"
    }).addTo(map);

    const bounds = [];

    const projectIcon = L.divIcon({
        className: "custom-map-icon",
        html: '<div class="project-marker"></div>',
        iconSize: [14, 14],
        iconAnchor: [7, 7]
    });

    const officeIcon = L.divIcon({
        className: "custom-map-icon",
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

    projectLocations.forEach(project => {
        const lat = parseFloat(project.latitude);
        const lng = parseFloat(project.longitude);

        if (isNaN(lat) || isNaN(lng)) return;

        bounds.push([lat, lng]);

        const title = project.title || "";
        const locationText = [project.city, project.country].filter(Boolean).join(", ");

        const popup = `
            <div class="map-popup">
                <p class="map-popup-title">${title}</p>
                <p class="map-popup-text">${locationText}</p>
            </div>
        `;

        L.marker([lat, lng], { icon: projectIcon })
            .addTo(map)
            .bindPopup(popup);
    });

    offices.forEach(office => {
        const lat = parseFloat(office.latitude);
        const lng = parseFloat(office.longitude);

        if (isNaN(lat) || isNaN(lng)) return;

        bounds.push([lat, lng]);

        const officeName = office.office_name || "";
        const locationText = [office.city, office.country].filter(Boolean).join(", ");
        const addressText = office.address_text || "";

        const popup = `
            <div class="map-popup">
                <p class="map-popup-title">${officeName}</p>
                <p class="map-popup-text">${locationText}</p>
                ${addressText ? `<p class="map-popup-text">${addressText}</p>` : ""}
            </div>
        `;

        L.marker([lat, lng], { icon: officeIcon })
            .addTo(map)
            .bindPopup(popup);
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

        map.dragging.disable();
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();
        map.boxZoom.disable();
        map.keyboard.disable();

        if (map.tap) {
            map.tap.disable();
        }
    }

    fitMapProperly();
    setTimeout(fitMapProperly, 200);
    setTimeout(fitMapProperly, 600);

    window.addEventListener("resize", fitMapProperly);
    window.addEventListener("orientationchange", fitMapProperly);
});