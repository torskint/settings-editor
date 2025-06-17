<?php

namespace SettingsEditor\Helpers;

class Fields
{
    protected static $config_key = 'torskint-settings-editor.fields';

    /**
     * Ajoute les alias définis dans un champ à la structure des paramètres.
     *
     * @param array $settings Référence au tableau des paramètres à compléter.
     * @param array $field    Champ de configuration contenant éventuellement des alias.
     */
    public static function applyAliases(array &$settings, array $field, mixed $default = null): void
    {
        if ( ! empty($field['as']) && is_array($field['as']) ) {
            foreach ($field['as'] as $aliasKey) {
                $settings[$aliasKey] = $default;
            }
        }
    }

    public static function get(string $key): array
    {
        $fields = self::all();
        if ( !empty($fields[$key]) ) {
            return $fields[$key];
        }
        return [];
    }

    public static function all(): array
    {
        return config( self::$config_key );
    }

}
