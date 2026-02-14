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
        $locale = $this->getPreferredLocale($request);

        // Set application locale
        App::setLocale($locale);

        // Store locale in session for persistence
        Session::put('locale', $locale);

        return $next($request);
    }

    /**
     * Get the preferred locale from various sources.
     */
    protected function getPreferredLocale(Request $request): string
    {
        // 1. Check query parameter (?locale=vi)
        if ($request->has('locale') && $this->isValidLocale($request->query('locale'))) {
            return $request->query('locale');
        }

        // 2. Check session for stored locale
        if (Session::has('locale') && $this->isValidLocale(Session::get('locale'))) {
            return Session::get('locale');
        }

        // 3. Check browser Accept-Language header
        $browserLocale = $this->getBrowserLocale($request);
        if ($browserLocale) {
            return $browserLocale;
        }

        // 4. Fall back to app default locale
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

        $supportedLocales = ['en', 'vi'];

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
