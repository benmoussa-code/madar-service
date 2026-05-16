<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:client,provider'],
            'main_service' => ['nullable', 'string'],
            'custom_service' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Auto-create service for providers
        if ($user->role === 'provider' && $request->filled('main_service')) {
            $mainService = $request->main_service;
            $categoryId = null;
            $title = '';

            if ($mainService === 'other' && $request->filled('custom_service')) {
                // Check if category already exists (case-insensitive)
                $existingCategory = \App\Models\Category::where('name', 'like', $request->custom_service)->first();
                
                if ($existingCategory) {
                    $categoryId = $existingCategory->id;
                    $title = $existingCategory->name;
                } else {
                    // Create a NEW CATEGORY on the fly
                    $newCategory = \App\Models\Category::create([
                        'name' => $request->custom_service,
                        'slug' => \Illuminate\Support\Str::slug($request->custom_service) ?: 'service-' . time(),
                        'icon' => 'star',
                    ]);
                    $categoryId = $newCategory->id;
                    $title = $newCategory->name;
                }
            } elseif (is_numeric($mainService)) {
                $category = \App\Models\Category::find($mainService);
                if ($category) {
                    $categoryId = $category->id;
                    $title = $category->name;
                }
            }

            if ($categoryId) {
                \App\Models\Service::create([
                    'user_id' => $user->id,
                    'category_id' => $categoryId,
                    'title' => $title,
                    'description' => 'Découvrez mes services professionnels de ' . $title . '. Contactez-moi pour plus de détails.',
                    'status' => 'approved',
                    'price' => 0,
                    'views' => 0,
                ]);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
