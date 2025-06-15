<?php

namespace SettingsEditor\Helpers;

class Settings
{
    protected static $path = 'app/torskint-settings-editor.json';

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

    public static function set($key, $value)
    {
        $settings = self::all();
        $settings[$key] = $value;
        file_put_contents(storage_path(self::$path), json_encode($settings, JSON_PRETTY_PRINT));
    }

    public static function load()
    {
        $settings = self::all();
        foreach (array_keys(config('torskint-settings-editor.fields')) as $key) {
            $constant = strtoupper($key);
            $value = $settings[$key] ?? null;

            if ( ! defined($constant) ) {
                define($constant, $value);
            }
        }
    }
}
