<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_providers' => \App\Models\User::where('role', 'provider')->count(),
            'avg_satisfaction' => \App\Models\Review::avg('rating') ?: 0,
            'pending_services' => \App\Models\Service::where('status', 'pending')->count(),
        ];
        
        $users = \App\Models\User::where('role', '!=', 'admin')->latest()->take(10)->get();
        $recentServices = \App\Models\Service::where('status', 'pending')->latest()->get();
        $recentAnnouncements = \App\Models\Announcement::latest()->take(10)->get();
        
        return view('admin.dashboard', compact('stats', 'users', 'recentServices', 'recentAnnouncements'));
    }

    public function destroyAnnouncement(\App\Models\Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Annonce supprimée avec succès.');
    }

    public function destroyUser(\App\Models\User $user)
    {
        if ($user->role === 'admin') abort(403);
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function showProvider(\App\Models\User $user)
    {
        if ($user->role !== 'provider') abort(404);
        $services = $user->services()->with('portfolioImages')->latest()->get();
        return view('admin.provider-show', compact('user', 'services'));
    }

    public function destroyService(\App\Models\Service $service)
    {
        $service->delete();
        return back()->with('success', 'Service supprimé avec succès.');
    }

    public function updateServiceStatus(\App\Models\Service $service, Request $request)
    {
        $service->update(['status' => $request->status]);
        return back()->with('success', 'Statut du service mis à jour.');
    }

    public function categories()
    {
        $categories = \App\Models\Category::all();
        return view('admin.categories', compact('categories'));
    }
}
