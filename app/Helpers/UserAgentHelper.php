<?php

namespace App\Helpers;

class UserAgentHelper
{
    public static function browser(string $ua): string
    {
        $browsers = [
            'Edge' => 'Edg',
            'Opera' => 'OPR',
            'Chrome' => 'Chrome',
            'Safari' => 'Safari',
            'Firefox' => 'Firefox',
        ];

        foreach ($browsers as $name => $keyword) {
            if (stripos($ua, $keyword) !== false) {
                return $name;
            }
        }

        return 'Unknown Browser';
    }

    public static function os(string $ua): string
    {
        $oses = [
            'Windows' => 'Windows NT',
            'macOS' => 'Macintosh',
            'iOS' => 'iPhone',
            'iPadOS' => 'iPad',
            'Android' => 'Android',
            'Linux' => 'Linux',
        ];

        foreach ($oses as $name => $keyword) {
            if (stripos($ua, $keyword) !== false) {
                return $name;
            }
        }

        return 'Unknown OS';
    }

    public static function device(string $ua): string
    {
        $ua = strtolower($ua);

        // Phone
        if (str_contains($ua, 'iphone') || (str_contains($ua, 'android') && str_contains($ua, 'mobile'))) {
            return 'Phone';
        }

        // Tablet
        if (str_contains($ua, 'ipad') || (str_contains($ua, 'android') && !str_contains($ua, 'mobile'))) {
            return 'Tablet';
        }

        // Desktop
        if (str_contains($ua, 'macintosh') || str_contains($ua, 'windows nt') || str_contains($ua, 'linux')) {
            return 'Desktop';
        }

        return 'Unknown Device';
    }

    public static function browserVersion(string $ua): ?string
    {
        $patterns = [
            'Chrome' => '/Chrome\/([\d\.]+)/',
            'Firefox' => '/Firefox\/([\d\.]+)/',
            'Safari' => '/Version\/([\d\.]+)/',
            'Edge' => '/Edg\/([\d\.]+)/',
            'Opera' => '/OPR\/([\d\.]+)/',
        ];

        foreach ($patterns as $browser => $pattern) {
            if (preg_match($pattern, $ua, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    public static function osVersion(string $ua): ?string
    {
        // macOS
        if (preg_match('/Mac OS X ([\d_]+)/', $ua, $matches)) {
            return str_replace('_', '.', $matches[1]);
        }

        // Windows
        if (preg_match('/Windows NT ([\d\.]+)/', $ua, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
