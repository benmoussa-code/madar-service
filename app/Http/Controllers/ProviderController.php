<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $services = $user->services()->latest()->get();
        $messages = \App\Models\Message::where('receiver_id', $user->id)->with('sender')->latest()->get();
        $stats = [
            'total_services' => $services->count(),
            'total_views' => $services->sum('views'),
            'total_reviews' => \App\Models\Review::whereIn('service_id', $services->pluck('id'))->count(),
        ];
        return view('provider.dashboard', compact('services', 'stats', 'messages'));
    }
}
