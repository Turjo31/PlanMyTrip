<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ActivityController extends Controller
{
    /**
     * Track user login activity.
     * Stores last login time in both session and cookie.
     * Called right after a successful login.
     */
    public static function trackLogin()
    {
        $now = now()->format('M d, Y h:i A');

        // Store last login time in session (temporary, cleared on logout)
        session(['last_login' => $now]);

        // Also store in cookie (persists for 30 days even after logout)
        Cookie::queue('last_login', $now, 60 * 24 * 30);
    }

    /**
     * Get the last login time.
     * Checks session first, then falls back to cookie.
     * Returns null if never logged in before.
     */
    public static function getLastLogin()
    {
        // Try session first (most recent)
        if (session('last_login')) {
            return session('last_login');
        }

        // Fall back to cookie (from previous session)
        if (request()->cookie('last_login')) {
            return request()->cookie('last_login');
        }

        return null;
    }

    /**
     * Clear login activity data on logout.
     * Removes session data but keeps cookie for next login reference.
     */
    public static function clearSession()
    {
        session()->forget('last_login');
    }
}