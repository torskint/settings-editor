<?php

namespace SettingsEditor\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class InjectGoogleTagManager
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Vérifie que la constante GOOGLE_TAG_MANAGER_ID existe et contient une valeur valide
        if (
            $request->routeIs('torskint.settings_editor') ||
            $request->routeIs('torskint.settings_editor.*') || 
            !defined('GOOGLE_TAG_MANAGER_ID') || 
            empty(GOOGLE_TAG_MANAGER_ID) ) {
            return $response;
        }

        // Ne pas injecter dans les réponses non-HTML
        if (!$response instanceof Response || stripos($response->headers->get('Content-Type'), 'text/html') === false) {
            return $response;
        }
        $html = $response->getContent();

        // Code Google Tag Manager
        $GOOGLE_TAG_MANAGER_ID = htmlspecialchars(GOOGLE_TAG_MANAGER_ID, ENT_QUOTES);

        $gtmHead = <<<HTML
            <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{$GOOGLE_TAG_MANAGER_ID}');
            </script>
            <!-- End Google Tag Manager -->
        HTML;

        $gtmBody = <<<HTML
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={$GOOGLE_TAG_MANAGER_ID}"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
        HTML;

        // Injection sûre dans <head> et <body>
        $html = preg_replace('/<head([^>]*)>/i', '<head$1>' . "\n" . $gtmHead, $html, 1);
        $html = preg_replace('/<body([^>]*)>/i', '<body$1>' . "\n" . $gtmBody, $html, 1);

        $response->setContent($html);

        return $response;
    }
}
