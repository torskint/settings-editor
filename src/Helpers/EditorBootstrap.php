<?php

namespace SettingsEditor\Helpers;

class EditorBootstrap
{
    public static function boot(): void
    {
        Settings::init();
        Settings::load();
    }
}
