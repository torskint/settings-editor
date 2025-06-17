<?php

namespace Torskint\SettingsEditor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SettingsEditor\Helpers\Fields;

class SettingsEditorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $fields = Fields::all();

        return collect($fields)->mapWithKeys(function ($config, $key) {
            $rules = [];

            if (!empty($config['required'])) {
                $rules[] = 'required';
            } else {
                $rules[] = 'nullable';
            }

            if (!empty($config['type'])) {
                switch ($config['type']) {
                    case 'email':
                        $rules[] = 'email';
                        break;
                    case 'url':
                        $rules[] = 'url';
                        break;
                    case 'number':
                        $rules[] = 'numeric';
                        break;
                    case 'tel':
                        $rules[] = 'string';
                        break;
                    case 'text':
                        $rules[] = 'string';
                        break;
                }
            }

            return [$key => $rules];
        })->toArray();
    }


    // /**
    //  * Filtre uniquement les champs autorisés
    //  */
    // public function validated($key = null, $default = null)
    // {
    //     $validKeys = array_keys(Settings::fields());

    //     return collect(parent::validated())
    //         ->only($validKeys)
    //         ->toArray();
    // }
}
