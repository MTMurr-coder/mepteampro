(function () {
    const mapEl = document.getElementById("projects-map");
    if (!mapEl || typeof L === "undefined") return;

    const projectLocations = window.projectLocations || [];
    const officeLocations = window.officeLocations || [];

    const map = L.map("projects-map", {
        scrollWheelZoom: false,
    }).setView([33.9, 35.5], 3);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 18,
        attribution: "&copy; OpenStreetMap contributors"
    }).addTo(map);

    const bounds = [];

    projectLocations.forEach((project) => {
        if (!project.latitude || !project.longitude) return;

        const marker = L.marker([project.latitude, project.longitude]).addTo(map);
        marker.bindPopup(`
            <strong>${project.title ?? "Project"}</strong><br>
            ${project.city ?? ""}${project.city && project.country ? ", " : ""}${project.country ?? ""}
        `);

        bounds.push([project.latitude, project.longitude]);
    });

    officeLocations.forEach((office) => {
        if (!office.latitude || !office.longitude) return;

        const marker = L.circleMarker([office.latitude, office.longitude], {
            radius: 9,
            weight: 2,
            fillOpacity: 0.95
        }).addTo(map);

        marker.bindPopup(`
            <strong>${office.office_name ?? "Office"}</strong><br>
            ${office.city ?? ""}${office.city && office.country ? ", " : ""}${office.country ?? ""}<br>
            ${office.address_text ?? ""}
        `);

        bounds.push([office.latitude, office.longitude]);
    });

    if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [40, 40] });
    }
})();