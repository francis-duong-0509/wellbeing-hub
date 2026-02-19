<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check query parameter (?locale=vi) and update session if valid
        if ($request->has('locale') && $this->isValidLocale($request->query('locale'))) {
            $locale = $request->query('locale');
            
            // Set locale in session
            Session::put('locale', $locale);
            
            // Set app locale immediately so it applies to current lifecycle even before redirect (optional but safe)
            App::setLocale($locale);

            // Redirect to clean URL (remove 'locale' query param) to avoid URL pollution
            return redirect($request->fullUrlWithQuery(['locale' => null]));
        }

        // 2. Get preferred locale from session or browser
        $locale = $this->getPreferredLocale($request);

        // 3. Set application locale
        App::setLocale($locale);

        return $next($request);
    }

    /**
     * Get the preferred locale from various sources.
     */
    protected function getPreferredLocale(Request $request): string
    {
        // Check session for stored locale
        if (Session::has('locale') && $this->isValidLocale(Session::get('locale'))) {
            return Session::get('locale');
        }

        // Check browser Accept-Language header
        $browserLocale = $this->getBrowserLocale($request);
        if ($browserLocale) {
            return $browserLocale;
        }

        // Fall back to app default locale
        return config('app.locale', 'en');
    }

    /**
     * Check if locale is valid/supported.
     */
    protected function isValidLocale(?string $locale): bool
    {
        if (! $locale) {
            return false;
        }

        // Best practice: Move this to config/app.php like 'supported_locales' => ['en', 'vi']
        // For now we keep it here but easy to maintain.
        $supportedLocales = config('app.supported_locales', ['en', 'vi']);

        return in_array($locale, $supportedLocales);
    }

    /**
     * Get locale from browser Accept-Language header.
     */
    protected function getBrowserLocale(Request $request): ?string
    {
        $acceptLanguage = $request->header('Accept-Language');

        if (! $acceptLanguage) {
            return null;
        }

        // Parse Accept-Language header
        // Example: "vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7"
        $languages = explode(',', $acceptLanguage);

        foreach ($languages as $language) {
            // Extract language code (before "-" or ";")
            $code = strtok($language, '-;');

            if ($this->isValidLocale($code)) {
                return $code;
            }
        }

        return null;
    }
}
