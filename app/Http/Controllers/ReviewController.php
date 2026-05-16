<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, \App\Models\Service $service)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        \App\Models\Review::create([
            'service_id' => $service->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Merci pour votre avis !');
    }

    public function reply(Request $request, \App\Models\Review $review)
    {
        // Check if the current user is the owner of the service
        if (auth()->id() !== $review->service->user_id) {
            abort(403);
        }

        $request->validate([
            'reply' => 'required|string|max:500',
        ]);

        $review->update([
            'reply' => $request->reply,
        ]);

        return back()->with('success', 'Votre réponse a été enregistrée.');
    }
}
