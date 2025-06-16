<?php

namespace SettingsEditor\Helpers;

class Settings
{
    protected static $path              = 'app/torskint-settings-editor.json';
    protected static $config_key        = 'torskint-settings-editor.fields';
    protected static $constant_file     = 'app/constants.php';


    public static function get($key, $default = null)
    {
        $settings = self::all();
        return $settings[$key] ?? $default;
    }

    public static function all()
    {
        $path = storage_path(self::$path);
        if (!file_exists($path)) return [];
        return json_decode(file_get_contents($path), true);
    }

    public static function init()
    {
        $path = storage_path(self::$path);
        if ( !file_exists($path) ) {

            $settings = [];
            foreach (config(self::$config_key) as $key => $field) {
                $settings[$key] = null;
            }
            file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
        }
    }

    public static function set($key, $value)
    {
        $settings = self::all();
        $settings[$key] = $value;
        file_put_contents(storage_path(self::$path), json_encode($settings, JSON_PRETTY_PRINT));
    }

    public static function load()
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

    private static function tse_safe_define($name)
    {
        // Ne pas agir si la constante n'est pas encore définie
        if (!defined($name)) {
            return true;
        }

        $constantsFile = base_path(self::$constant_file);
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

        // $pattern = '/define\(\s*[\'"]' . preg_quote($name, '/') . '[\'"]\s*,\s*.*?\);/';
        // $fileContent = preg_replace_callback($pattern, function ($matches) {
        //     return '// ' . $matches[0]; // commente la ligne
        // }, $fileContent, 1); // 1 = une seule fois

        // Évite d’écraser si aucune modification
        if ($newContent !== $fileContent) {
            file_put_contents($constantsFile, $newContent);
            return true;
        }

        return false;
    }
}
