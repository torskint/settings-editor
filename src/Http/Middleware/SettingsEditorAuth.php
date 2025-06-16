<?php

namespace SettingsEditor\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SettingsEditorAuth
{
    public function handle(Request $request, Closure $next)
    {
        if ( ! session('module_authenticated') ) {
            return redirect()->route('torskint.settings_editor.login'); // à adapter selon ta route login
        }

        return $next($request);
    }
}
