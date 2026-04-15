<footer class="site-footer">
    <div class="container">
        <p>
            © <?= date('Y') ?>
            <?= e(site_text($pdo, 'site_title', $lang)) ?> —
            <?= e(site_text($pdo, 'footer_text', $lang)) ?>
        </p>
    </div>
</footer>

<script>
    window.projectLocations = <?= json_encode($projectLocations ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
    window.officeLocations = <?= json_encode($offices ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="/assets/js/theme.js"></script>
<script src="/assets/js/map.js"></script>

</body>
</html>