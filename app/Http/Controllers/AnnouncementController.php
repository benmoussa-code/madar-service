<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Announcement::with(['user', 'category'])->where('status', 'open');

        // If it's a provider, show only announcements that match their expertise (categories)
        if ($user && $user->role === 'provider') {
            $myCategoryIds = $user->services()->pluck('category_id')->unique();
            if ($myCategoryIds->isNotEmpty()) {
                $query->whereIn('category_id', $myCategoryIds);
            }
        }

        $announcements = $query->latest()->paginate(10);
            
        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('announcements.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'service_date' => 'required|date|after_or_equal:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['category_id', 'title', 'description', 'service_date']);
        $data['user_id'] = auth()->id();
        $data['status'] = 'open';

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('announcements', 'public');
            $data['image'] = $path;
        }

        Announcement::create($data);

        return redirect()->route('home')->with('success', 'Votre annonce a été publiée avec succès.');
    }
}
