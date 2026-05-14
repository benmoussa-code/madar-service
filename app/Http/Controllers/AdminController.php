<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => \App\Models\User::count(),
            'services' => \App\Models\Service::count(),
            'pending_services' => \App\Models\Service::where('status', 'pending')->count(),
            'reviews' => \App\Models\Review::count(),
        ];
        $recentServices = \App\Models\Service::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentServices'));
    }

    public function users()
    {
        $users = \App\Models\User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function updateUserStatus(\App\Models\User $user, Request $request)
    {
        $user->update(['status' => $request->status]);
        return back()->with('success', 'Statut de l\'utilisateur mis à jour.');
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
