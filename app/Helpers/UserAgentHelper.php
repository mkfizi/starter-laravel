<?php

namespace App\Helpers;

/**
 * User Agent Helper
 * 
 * Provides utility methods for parsing and analyzing HTTP User-Agent strings.
 * Extracts information about browsers, operating systems, devices, and their versions.
 * 
 * Used primarily for session tracking and analytics purposes.
 */
class UserAgentHelper
{
    /**
     * Detect the browser from a user agent string.
     * 
     * Identifies common browsers by searching for their unique identifiers.
     * Checks in order: Edge, Opera, Chrome, Safari, Firefox.
     * 
     * @param string $ua The user agent string to parse
     * @return string The browser name or 'Unknown Browser'
     */
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

    /**
     * Detect the operating system from a user agent string.
     * 
     * Identifies common operating systems including Windows, macOS, iOS, iPadOS,
     * Android, and Linux.
     * 
     * @param string $ua The user agent string to parse
     * @return string The OS name or 'Unknown OS'
     */
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

    /**
     * Detect the device type from a user agent string.
     * 
     * Categorizes devices into Phone, Tablet, or Desktop based on
     * keywords in the user agent string.
     * 
     * @param string $ua The user agent string to parse
     * @return string The device type: 'Phone', 'Tablet', 'Desktop', or 'Unknown Device'
     */
    public static function device(string $ua): string
    {
        $ua = strtolower($ua);

        // Phone: iPhone or Android mobile devices
        if (str_contains($ua, 'iphone') || (str_contains($ua, 'android') && str_contains($ua, 'mobile'))) {
            return 'Phone';
        }

        // Tablet: iPad or non-mobile Android devices
        if (str_contains($ua, 'ipad') || (str_contains($ua, 'android') && !str_contains($ua, 'mobile'))) {
            return 'Tablet';
        }

        // Desktop: macOS, Windows, or Linux systems
        if (str_contains($ua, 'macintosh') || str_contains($ua, 'windows nt') || str_contains($ua, 'linux')) {
            return 'Desktop';
        }

        return 'Unknown Device';
    }

    /**
     * Extract the browser version from a user agent string.
     * 
     * Uses regex patterns to match version numbers for common browsers.
     * 
     * @param string $ua The user agent string to parse
     * @return string|null The browser version (e.g., '120.0.6099.109') or null if not found
     */
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

    /**
     * Extract the operating system version from a user agent string.
     * 
     * Currently supports version detection for macOS and Windows.
     * 
     * @param string $ua The user agent string to parse
     * @return string|null The OS version (e.g., '10.15.7' for macOS, '10.0' for Windows) or null if not found
     */
    public static function osVersion(string $ua): ?string
    {
        // macOS: Extract version from 'Mac OS X 10_15_7' format
        if (preg_match('/Mac OS X ([\d_]+)/', $ua, $matches)) {
            return str_replace('_', '.', $matches[1]);
        }

        // Windows: Extract version from 'Windows NT 10.0' format
        if (preg_match('/Windows NT ([\d\.]+)/', $ua, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
