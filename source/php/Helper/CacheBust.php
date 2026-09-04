<?php

namespace AlingsasHero\Helper;

/**
 * Class CacheBust
 *
 * Handles resolving hashed filenames from the Vite manifest.
 *
 * @package AlingsasHero\Helper
 */
class CacheBust
{
    private static ?array $manifest = null;

    /**
     * Get the hashed filename from the manifest
     *
     * @param string $name The original filename (e.g., 'css/modularity-alingsashero.css')
     * @return string|false The hashed filename or false if not found
     */
    public static function name(string $name): string|false
    {
        $resolved = self::resolve($name);

        return $resolved ?? false;
    }

    /**
     * Public URL for a built dist asset, or false when the file is missing.
     *
     * @param string $name The original filename (e.g., 'css/modularity-alingsashero.css')
     * @return string|false
     */
    public static function distUrl(string $name): string|false
    {
        $relative = self::name($name) ?: $name;
        $relative = ltrim($relative, '/');
        $path = ALINGAS_HERO_PATH . 'dist/' . $relative;

        if (!is_readable($path)) {
            return false;
        }

        return ALINGAS_HERO_URL . '/dist/' . $relative;
    }

    /**
     * Load and cache the manifest file
     *
     * @return array|null The manifest array or null if not found
     */
    private static function getManifest(): ?array
    {
        if (self::$manifest !== null) {
            return self::$manifest;
        }

        $manifestPath = ALINGAS_HERO_PATH . 'dist/manifest.json';

        if (file_exists($manifestPath)) {
            $decoded = json_decode((string) file_get_contents($manifestPath), true);
            self::$manifest = is_array($decoded) ? $decoded : [];
            return self::$manifest;
        }

        return null;
    }

    /**
     * @param string $name Manifest key (simple map) or Vite `{ file: ... }` entry
     * @return string|null
     */
    private static function resolve(string $name): ?string
    {
        $manifest = self::getManifest();

        if (!is_array($manifest) || !array_key_exists($name, $manifest)) {
            return null;
        }

        $entry = $manifest[$name];

        if (is_string($entry) && $entry !== '') {
            return $entry;
        }

        if (is_array($entry) && isset($entry['file']) && is_string($entry['file']) && $entry['file'] !== '') {
            return $entry['file'];
        }

        return null;
    }
}

