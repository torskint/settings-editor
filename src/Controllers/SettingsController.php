<?php

namespace SettingsEditor\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use SettingsEditor\Helpers\Settings;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

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


    public function robots_txt()
    {
        $mainPath = public_path('robots.txt');
        $modulePath = public_path('vendor/settings-editor/robots.txt');

        $mainContent = File::exists($mainPath) ? File::get($mainPath) : '';
        $moduleContent = File::exists($modulePath) ? File::get($modulePath) : '';

        dd( $mainContent, $modulePath, $moduleContent );

        $merged = trim($mainContent . "\n\n" . $moduleContent);

        return Response::make($merged, 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
