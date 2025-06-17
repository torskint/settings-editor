<?php

namespace SettingsEditor\Helpers;

class Settings
{
    protected static $path          = null;
    protected static $config_key    = 'torskint-settings-editor.storage_file';
    protected static $constant_key  = 'torskint-settings-editor.constant_file';

    protected static function getStoragePath(): string
    {
        if (is_null(self::$path)) {
            self::$path = config( self::$config_key );
        }
        return storage_path(self::$path);
    }

    // public static function get(string $key): mixed
    // {
    //     $settings = self::all();
    //     if ( !empty($settings[$key]) ) {
    //         return $settings[$key];
    //     }
    //     return null;
    // }

    public static function all(): array
    {
        if ( file_exists( $path = self::getStoragePath() ) ) {
            return json_decode(file_get_contents($path), true) ?? [];
        }
        return [];
    }

    public static function init(): void
    {
        $settings = [];
        if ( ! file_exists( $path = self::getStoragePath() ) ) {
            foreach (Fields::all() as $key => $field) {
                $settings[$key] = null;

                Fields::applyAliases($settings, $field);
            }
            file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
        }
    }

    public static function set(string $key, $value): void
    {
        $settings = self::all();
        $settings[$key] = $value;
        Fields::applyAliases($settings, Fields::get($key), $value);

        file_put_contents(self::getStoragePath(), json_encode($settings, JSON_PRETTY_PRINT));
    }

    public static function load(): void
    {
        foreach (self::all() as $key => $value) {
            $constant = strtoupper($key);

            self::safe_define($constant);

            if ( ! defined($constant) ) {
                define($constant, $value);
            }
        }
    }

    private static function safe_define(string $name): bool
    {
        // Ne pas agir si la constante n'est pas encore définie
        if (!defined($name)) {
            return true;
        }

        $constantsFile = base_path( config(self::$constant_key) );
        if ( ! file_exists($constantsFile) ) {
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
