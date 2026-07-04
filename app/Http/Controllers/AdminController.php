<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Post;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin dashboard with site statistics
    public function dashboard()
    {
        $totalUsers        = User::where('role', 'user')->count();
        $totalTrips        = Trip::count();
        $activeThisMonth   = User::whereMonth('created_at', now()->month)->count();
        $totalAnnouncements = Announcement::count();
        $recentUsers       = User::where('role', 'user')->latest()->take(5)->get();
        $recentTrips       = Trip::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTrips',
            'activeThisMonth',
            'totalAnnouncements',
            'recentUsers',
            'recentTrips'
        ));
    }

    // Manage users
    public function users()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users', compact('users'));
    }

    // Activate / deactivate user
    public function toggleUser(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.users')->with('success', "User {$status} successfully!");
    }

    // Manage announcements
    public function announcements()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcements', compact('announcements'));
    }
}