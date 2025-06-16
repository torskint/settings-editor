<?php

namespace SettingsEditor\Helpers;

class Settings
{
    protected static $path          = null;
    protected static $config_key    = 'torskint-settings-editor.fields';

    protected static function getStoragePath(): string
    {
        if (is_null(self::$path)) {
            self::$path = config('torskint-settings-editor.storage_file');
        }
        return storage_path(self::$path);
    }

    public static function get(string $key, mixed $default = null)
    {
        $settings = self::all();
        return $settings[$key] ?? $default;
    }

    public static function all(): array
    {
        $path = self::getStoragePath();
        if (!file_exists($path)) return [];
        return json_decode(file_get_contents($path), true) ?? [];
    }

    public static function init(): void
    {
        $path = self::getStoragePath();
        if ( !file_exists($path) ) {

            $settings = [];
            foreach (config(self::$config_key) as $key => $field) {
                $settings[$key] = null;
            }
            file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
        }
    }

    public static function set(string $key, $value): void
    {
        $settings = self::all();
        $settings[$key] = $value;
        file_put_contents(self::getStoragePath(), json_encode($settings, JSON_PRETTY_PRINT));
    }

    public static function load(): void
    {
        $settings = self::all();
        foreach (array_keys(config(self::$config_key)) as $key) {
            $constant = strtoupper($key);

            self::tse_safe_define($constant);

            if ( ! defined($constant) ) {
                define($constant, $settings[$key]);
            }
        }
    }

    private static function tse_safe_define(string $name): bool
    {
        // Ne pas agir si la constante n'est pas encore définie
        if (!defined($name)) {
            return true;
        }

        $constantsFile = base_path( config('torskint-settings-editor.constant_file') );
        if ( !file_exists($constantsFile) ) {
            return false;
        }
        $fileContent = file_get_contents($constantsFile);

        // Recherche précise avec début de ligne pour éviter les doublons partiels
        $pattern = '/^(\s*)define\(\s*[\'"]' . preg_quote($name, '/') . '[\'"]\s*,\s*.+?\);\s*$/im';

        // Remplace une seule occurrence en commentant proprement
        $newContent = preg_replace_callback($pattern, function ($matches) {
            return $matches[1] . '// ' . ltrim($matches[0]);
        }, $fileContent, 1);

        // Évite d’écraser si aucune modification
        if ($newContent !== $fileContent) {
            file_put_contents($constantsFile, $newContent);
            return true;
        }

        return false;
    }
}
