<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use GeoIP;

class DetectLocale
{
    public function handle($request, Closure $next)
    {
        $defaultLocale = config('app.locale'); // default: en

        try {
            $location = geoip()->getLocation($request->ip());
            $countryCode = $location->iso_code;

            $locales = [
                'MY' => 'ms',
                'ID' => 'id',
                'US' => 'en',
                'PH' => 'en',
                // tambahkan sesuai kebutuhan
            ];

            $locale = $locales[$countryCode] ?? $defaultLocale;
            App::setLocale($locale);
        } catch (\Exception $e) {
            App::setLocale($defaultLocale);
        }

        return $next($request);
    }
}
