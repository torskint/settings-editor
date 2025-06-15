<?php

namespace SettingsEditor\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use SettingsEditor\Helpers\Settings;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('settings-editor::pages.settings', ['settings' => Settings::all()]);
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Settings::set($key, $value);
        }

        return redirect()->back()->with('success', 'Paramètres mis à jour.');
    }
}
