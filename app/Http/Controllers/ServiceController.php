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
        // If a provider tries to browse the general catalog, redirect to their dashboard
        if (auth()->check() && auth()->user()->role === 'provider') {
            return redirect()->route('provider.dashboard');
        }

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
            'portfolio.*' => 'nullable|image|max:2048',
        ]);

        $service = new \App\Models\Service($request->all());
        $service->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
        }

        $service->save();

        if ($request->hasFile('portfolio')) {
            foreach ($request->file('portfolio') as $image) {
                $path = $image->store('portfolio', 'public');
                $service->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('provider.dashboard')->with('success', 'Service créé avec succès. En attente de validation.');
    }

    public function show(\App\Models\Service $service)
    {
        // Enforce policy: providers can only see their own services
        if (auth()->check() && auth()->user()->role === 'provider' && auth()->id() !== $service->user_id) {
            abort(403, 'Vous ne pouvez consulter que vos propres services.');
        }

        $service->increment('views');
        $service->load(['user', 'category', 'reviews.user', 'images']);
        return view('services.show', compact('service'));
    }

    public function edit(\App\Models\Service $service)
    {
        $this->authorize('update', $service);
        $categories = \App\Models\Category::all();
        $service->load('images');
        return view('provider.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, \App\Models\Service $service)
    {
        $this->authorize('update', $service);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'portfolio.*' => 'nullable|image|max:2048',
        ]);

        $service->fill($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
        }

        $service->save();

        if ($request->hasFile('portfolio')) {
            foreach ($request->file('portfolio') as $image) {
                $path = $image->store('portfolio', 'public');
                $service->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('provider.dashboard')->with('success', 'Service mis à jour.');
    }

    public function destroy(\App\Models\Service $service)
    {
        $this->authorize('delete', $service);
        $service->delete();
        return redirect()->route('provider.dashboard')->with('success', 'Service supprimé.');
    }
}
