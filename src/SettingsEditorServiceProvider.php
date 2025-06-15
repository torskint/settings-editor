<?php

namespace SettingsEditor;

use Illuminate\Support\ServiceProvider;

class SettingsEditorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require_once __DIR__ . '/Helpers/LoadSettings.php';
        
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'settings-editor');
        $this->publishes([

            __DIR__.'/config/torskint-settings-editor.php' => config_path('torskint-settings-editor.php'),
            __DIR__.'/../public' => public_path('vendor/settings-editor'),
            
        ], 'settings-editor');

        // $this->publishes([
        //     __DIR__.'/../public' => public_path('vendor/settings-editor'),
        // ], 'public');
        
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/torskint-settings-editor.php', 'torskint-settings-editor'
        );
        require_once __DIR__ . '/Helpers/Settings.php';
    }
}
