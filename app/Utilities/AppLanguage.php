<?php

namespace App\Utilities;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Request;

class AppLanguage
{
    /**
     * Return new url with language prefix.
     *
     * @param string $languageCode
     * @return UrlGenerator|string
     */
    public static function languageUrl($languageCode)
    {

        $pathData = [];
        $path = Request::getPathInfo();
        $param = Request::getQueryString();
        if ($param) {
            $param = '?' . $param;
        }
        if ($languageCode != config('app.default_language')) {
            $pathData[] = $languageCode;
        }

        $pathData[] = ltrim($path, '/vi/en');

        $pathStr = implode('/', $pathData) . $param;
        return url($pathStr);
    }
}
