<?php

namespace SettingsEditor\Helpers;

class Settings
{
    protected static $path = 'app/torskint-settings-editor.json';
    protected static $config_key = 'torskint-settings-editor.fields';

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

            if ( ! defined($constant) ) {
                define($constant, $settings[$key]);
            }
        }
    }
}
