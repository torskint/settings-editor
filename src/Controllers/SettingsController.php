<?php

namespace SettingsEditor\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use SettingsEditor\Helpers\Settings;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{

    public function login()
    {
        return view('settings-editor::pages.login');
    }


    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $filePath = storage_path('app/torskint-settings-editor-credentials.json');

        // Si aucun mot de passe n’a encore été défini (setup initial)
        if (!File::exists($filePath)) {
            $credentials = [
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            File::put($filePath, json_encode($credentials));

            Session::put('module_authenticated', true);
            return redirect()->route('torskint.settings_editor');
        }

        // Lecture des credentials
        $data = json_decode(File::get($filePath), true);

        if (
            $request->email === ($data['email'] ?? null) &&
            Hash::check($request->password, $data['password'] ?? '')
        ) {
            Session::put('module_authenticated', true);
            return redirect()->route('torskint.settings_editor');
        }

        return back()->withErrors(['danger' => 'Email ou mot de passe invalide.']);
    }



    public function edit()
    {
        return view('settings-editor::pages.settings', ['settings' => Settings::all()]);
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Settings::set($key, $value);
        }

        return back()->withErrors('success', 'Paramètres mis à jour.');
    }

}
