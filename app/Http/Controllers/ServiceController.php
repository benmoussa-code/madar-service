<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Service::where('status', 'approved');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $services = $query->latest()->paginate(12);
        $categories = \App\Models\Category::all();

        return view('services.index', compact('services', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('provider.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $service = new \App\Models\Service($request->all());
        $service->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
        }

        $service->save();

        return redirect()->route('provider.dashboard')->with('success', 'Service créé avec succès. En attente de validation.');
    }

    public function show(\App\Models\Service $service)
    {
        $service->increment('views');
        $service->load(['user', 'category', 'reviews.user']);
        return view('services.show', compact('service'));
    }

    public function edit(\App\Models\Service $service)
    {
        if (auth()->id() !== $service->user_id) abort(403);
        $categories = \App\Models\Category::all();
        return view('provider.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, \App\Models\Service $service)
    {
        if (auth()->id() !== $service->user_id) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $service->fill($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
        }

        $service->save();

        return redirect()->route('provider.dashboard')->with('success', 'Service mis à jour.');
    }

    public function destroy(\App\Models\Service $service)
    {
        if (auth()->id() !== $service->user_id) abort(403);
        $service->delete();
        return redirect()->route('provider.dashboard')->with('success', 'Service supprimé.');
    }
}
