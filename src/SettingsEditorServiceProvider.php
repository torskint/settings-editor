<?php

namespace SettingsEditor;

use Illuminate\Support\ServiceProvider;

class SettingsEditorServiceProvider extends ServiceProvider
{
    /**
     * Démarre le package (après l'enregistrement).
     * Charge les routes, vues, helpers et rend les ressources publiables.
     */
    public function boot()
    {
        // Charge le helper pour injecter les paramètres dynamiquement
        require_once __DIR__ . '/Helpers/LoadSettings.php';

        // Charge les routes du module
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        // Charge les vues avec le préfixe "settings-editor::"
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'settings-editor');

        app('router')->aliasMiddleware('torskint.settings.editor.auth', \SettingsEditor\Http\Middleware\SettingsEditorAuth::class);

        // Registre automatique du middleware
        app('router')->pushMiddlewareToGroup('web', \SettingsEditor\Http\Middleware\InjectGoogleTagManager::class);

        // Permet de publier le fichier de configuration
        $this->publishes([
            __DIR__.'/config/torskint-settings-editor.php' => config_path('torskint-settings-editor.php'),
        ], 'torskint-settings-editor-config');

        // Permet de publier les assets (JS, CSS...) dans le dossier public
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/settings-editor'),
        ], 'torskint-settings-editor-assets');
    }

    /**
     * Enregistre les services du package.
     * Fusionne la config par défaut et charge les fonctions utilitaires.
     */
    public function register()
    {
        // Fusionne la configuration par défaut avec celle de l'utilisateur
        $this->mergeConfigFrom(
            __DIR__.'/config/torskint-settings-editor.php',
            'torskint-settings-editor'
        );

        // Charge le helper global pour accéder aux paramètres
        require_once __DIR__ . '/Helpers/Settings.php';
    }
}
