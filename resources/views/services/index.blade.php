<x-app-layout>
    <div class="py-16 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Sidebar / Filters Enhanced -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white/40 sticky top-24">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Filtrer</h2>
                            <i class="fas fa-sliders-h text-slate-400"></i>
                        </div>
                        
                        <form action="{{ route('services.index') }}" method="GET" class="space-y-8">
                            <!-- Search Section -->
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Recherche</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-slate-300 group-focus-within:text-blue-500 transition-colors"></i>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                        class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 pl-11 py-3.5 text-sm transition-all" 
                                        placeholder="Que cherchez-vous ?">
                                </div>
                            </div>

                            <!-- Categories Section -->
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Catégories</label>
                                <div class="flex flex-wrap gap-2">
                                    <!-- All Categories Chip -->
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="category" value="" class="hidden peer" {{ !request('category') ? 'checked' : '' }}>
                                        <div class="px-4 py-2.5 rounded-xl border border-slate-100 bg-slate-50 text-slate-600 text-xs font-bold peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 peer-checked:shadow-lg peer-checked:shadow-blue-500/20 transition-all hover:bg-slate-100 group-active:scale-95">
                                            Toutes
                                        </div>
                                    </label>
                                    @foreach($categories as $category)
                                        <label class="cursor-pointer group">
                                            <input type="radio" name="category" value="{{ $category->slug }}" class="hidden peer" {{ request('category') == $category->slug ? 'checked' : '' }}>
                                            <div class="px-4 py-2.5 rounded-xl border border-slate-100 bg-slate-50 text-slate-600 text-xs font-bold peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 peer-checked:shadow-lg peer-checked:shadow-blue-500/20 transition-all hover:bg-slate-100 group-active:scale-95">
                                                {{ $category->name }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="pt-4 space-y-4">
                                <button type="submit" class="w-full bg-slate-900 text-white font-bold py-4 rounded-2xl hover:bg-blue-600 transition-all shadow-xl hover:shadow-blue-500/20 active:scale-[0.98] text-sm">
                                    Appliquer les filtres
                                </button>
                                <a href="{{ route('services.index') }}" class="block text-center text-[10px] font-bold text-slate-400 hover:text-slate-900 transition-colors uppercase tracking-[0.2em]">
                                    Réinitialiser
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Services List Enhanced -->
                <div class="w-full lg:w-3/4">
                    <div class="mb-10 flex flex-col md:flex-row justify-between md:items-end gap-6">
                        <div class="space-y-1">
                            <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                                @if(request('category'))
                                    {{ $categories->where('slug', request('category'))->first()->name }}
                                @else
                                    Tous les Services
                                @endif
                            </h1>
                            <p class="text-slate-400 text-sm font-medium">Trouvez l'expertise dont vous avez besoin aujourd'hui.</p>
                        </div>
                        <div class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-50 border border-blue-100 text-[11px] font-bold text-blue-600 uppercase tracking-widest">
                            <span class="mr-2">{{ $services->total() }}</span> services disponibles
                        </div>
                    </div>

                    @if($services->isEmpty())
                        <div class="bg-white p-20 rounded-[2.5rem] text-center shadow-sm border border-slate-100">
                            <div class="bg-slate-50 w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-300">
                                <i class="fas fa-search text-3xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900 mb-2">Aucun service trouvé</h2>
                            <p class="text-slate-400 text-sm max-w-xs mx-auto">Essayez d'ajuster vos filtres ou effectuez une nouvelle recherche.</p>
                        </div>
                    @else
                        <div class="grid md:grid-cols-2 gap-8">
                            @foreach($services as $service)
                                @php
                                    $defaultImgs = [
                                        'plomberie' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&q=80&w=600',
                                        'electricite' => 'https://images.unsplash.com/photo-1621905251918-48416bd8575a?auto=format&fit=crop&q=80&w=600',
                                        'peinture' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=600',
                                        'nettoyage' => 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=600',
                                        'climatisation' => 'https://images.unsplash.com/photo-1631541486121-69e0004ccf4f?auto=format&fit=crop&q=80&w=600',
                                        'menuiserie' => 'https://images.unsplash.com/photo-1533090161767-e6ffed986c88?auto=format&fit=crop&q=80&w=600',
                                    ];
                                    
                                    $rawImg = trim($service->image ?? '');
                                    if ($rawImg && (str_starts_with($rawImg, 'http') || str_starts_with($rawImg, '//'))) {
                                        $serviceImg = $rawImg;
                                    } elseif ($rawImg) {
                                        $serviceImg = asset('storage/' . $rawImg);
                                    } else {
                                        $serviceImg = $defaultImgs[$service->category->slug] ?? 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=600';
                                    }
                                @endphp
                                <div class="group bg-white rounded-[2.5rem] shadow-[0_4px_20px_rgb(0,0,0,0.03)] hover:shadow-[0_20px_50px_rgba(59,130,246,0.1)] transition-all duration-500 border border-slate-100 flex flex-col h-full overflow-hidden hover:-translate-y-2">
                                    <!-- Image Container -->
                                    <div class="h-60 relative overflow-hidden">
                                        <img src="{{ $serviceImg }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $service->title }}">
                                        
                                        <!-- Badges Layer -->
                                        <div class="absolute inset-0 p-6 flex flex-col justify-between pointer-events-none">
                                            <div class="flex justify-between items-start">
                                                <span class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl text-[10px] font-bold text-blue-600 shadow-sm uppercase tracking-widest border border-white/20">
                                                    {{ $service->category->name }}
                                                </span>
                                            </div>
                                            <div class="flex justify-end">
                                                <div class="bg-slate-900 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg">
                                                    {{ number_format($service->price, 0, '.', ' ') }} <span class="text-[10px] opacity-60 ml-0.5">DH</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-8 flex-1 flex flex-col">
                                        <h3 class="text-xl font-bold mb-3 text-slate-800 leading-snug group-hover:text-blue-600 transition-colors">
                                            {{ $service->title }}
                                        </h3>
                                        
                                        <div class="flex items-center gap-2 mb-6">
                                            <div class="flex text-yellow-400 text-[10px]">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= round($service->averageRating()) ? '' : 'text-slate-200' }}"></i>
                                                @endfor
                                            </div>
                                            <span class="text-slate-400 font-bold text-[10px] uppercase tracking-wider">
                                                {{ $service->reviews->count() }} avis
                                            </span>
                                        </div>

                                        <!-- Footer Info -->
                                        <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs shadow-inner">
                                                    {{ substr($service->user->name, 0, 1) }}
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider leading-none mb-1">Prestataire</span>
                                                    <span class="text-xs font-bold text-slate-700 line-clamp-1">{{ $service->user->name }}</span>
                                                </div>
                                            </div>
                                            
                                            <a href="{{ route('services.show', $service) }}" 
                                                class="bg-blue-50 text-blue-600 p-3 rounded-xl hover:bg-blue-600 hover:text-white transition-all active:scale-95 group/btn">
                                                <i class="fas fa-arrow-right text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-16">
                            {{ $services->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
