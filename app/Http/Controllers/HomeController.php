<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        $latestServices = \App\Models\Service::where('status', 'approved')->latest()->take(6)->get();
        return view('home', compact('categories', 'latestServices'));
    }
}
