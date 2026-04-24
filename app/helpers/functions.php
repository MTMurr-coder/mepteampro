<?php

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function current_lang(): string
{
    $lang = $_GET['lang'] ?? 'en';
    $allowed = ['en', 'fr', 'ar'];

    return in_array($lang, $allowed, true) ? $lang : 'en';
}

function is_rtl(string $lang): bool
{
    return $lang === 'ar';
}

function site_text(PDO $pdo, string $key, string $lang, string $fallback = 'en'): string
{
    static $cache = [];

    $cacheKey = $lang . ':' . $key;

    if (isset($cache[$cacheKey])) {
        return $cache[$cacheKey];
    }

    $stmt = $pdo->prepare(
        "SELECT text_value
         FROM site_texts
         WHERE text_key = ? AND lang = ?
         LIMIT 1"
    );
    $stmt->execute([$key, $lang]);
    $row = $stmt->fetch();

    if (!$row && $lang !== $fallback) {
        $stmt->execute([$key, $fallback]);
        $row = $stmt->fetch();
    }

    $cache[$cacheKey] = $row['text_value'] ?? $key;

    return $cache[$cacheKey];
}

function page_url(string $page = 'home', string $lang = 'en', array $extra = []): string
{
    $query = array_merge(['page' => $page, 'lang' => $lang], $extra);
    return '/?' . http_build_query($query);
}

function localized_field(array $row, string $baseKey, string $lang, string $fallback = 'en'): string
{
    $candidates = [];

    if ($lang !== '') {
        $candidates[] = $baseKey . '_' . $lang;
        $candidates[] = $baseKey . strtoupper($lang);
    }

    if ($fallback !== '' && $fallback !== $lang) {
        $candidates[] = $baseKey . '_' . $fallback;
        $candidates[] = $baseKey . strtoupper($fallback);
    }

    $candidates[] = $baseKey;

    foreach ($candidates as $candidate) {
        if (array_key_exists($candidate, $row)) {
            $value = trim((string) $row[$candidate]);
            if ($value !== '') {
                return $value;
            }
        }
    }

    return '';
}

function localized_project(array $project, string $lang): array
{
    $project['title'] = localized_field($project, 'title', $lang) ?: (string) ($project['title'] ?? '');
    $project['description'] = localized_field($project, 'description', $lang) ?: (string) ($project['description'] ?? '');
    $project['country'] = localized_field($project, 'country', $lang) ?: (string) ($project['country'] ?? '');
    $project['city'] = localized_field($project, 'city', $lang) ?: (string) ($project['city'] ?? '');
    $project['sector'] = localized_field($project, 'sector', $lang) ?: (string) ($project['sector'] ?? '');
    $project['area'] = localized_field($project, 'area', $lang) ?: (string) ($project['area'] ?? '');

    return $project;
}

function localized_office(array $office, string $lang): array
{
    $office['office_name'] = localized_field($office, 'office_name', $lang) ?: (string) ($office['office_name'] ?? '');
    $office['country'] = localized_field($office, 'country', $lang) ?: (string) ($office['country'] ?? '');
    $office['city'] = localized_field($office, 'city', $lang) ?: (string) ($office['city'] ?? '');
    $office['address_text'] = localized_field($office, 'address_text', $lang) ?: (string) ($office['address_text'] ?? '');

    return $office;
}

function map_translations(PDO $pdo, string $lang): array
{
    return [
        'projectLabel' => site_text($pdo, 'map_project_label', $lang),
        'officeLabel' => site_text($pdo, 'map_office_label', $lang),
        'locationLabel' => site_text($pdo, 'map_location_label', $lang),
        'addressLabel' => site_text($pdo, 'map_address_label', $lang),
        'noLocation' => site_text($pdo, 'map_no_location', $lang),
    ];
}
