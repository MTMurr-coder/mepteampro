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