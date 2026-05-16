<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'provider') {
            return redirect()->route('announcements.index');
        }

        $categories = \App\Models\Category::all();
        $latestServices = \App\Models\Service::where('status', 'approved')->latest()->take(6)->get();
        return view('home', compact('categories', 'latestServices'));
    }
}
