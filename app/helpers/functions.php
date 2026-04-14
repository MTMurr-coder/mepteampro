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