<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Sidebar / Filters Enhanced -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 sticky top-24">
                        <h2 class="text-2xl font-black mb-8 text-slate-900 tracking-tight">Filtrer</h2>
                        
                        <form action="{{ route('services.index') }}" method="GET">
                            <div class="mb-10">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Recherche</label>
                                <div class="relative">
                                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" name="search" value="{{ request('search') }}" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:ring-blue-500 focus:border-blue-500 pl-12 py-4" placeholder="Plombier...">
                                </div>
                            </div>

                            <div class="mb-10">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Catégories</label>
                                <div class="space-y-4">
                                    <div class="flex items-center group cursor-pointer">
                                        <input type="radio" name="category" value="" id="cat-all" {{ !request('category') ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500 h-5 w-5 border-slate-200">
                                        <label for="cat-all" class="ms-4 text-sm text-slate-600 font-bold group-hover:text-blue-600 transition-colors">Toutes</label>
                                    </div>
                                    @foreach($categories as $category)
                                        <div class="flex items-center group cursor-pointer">
                                            <input type="radio" name="category" value="{{ $category->slug }}" id="cat-{{ $category->id }}" {{ request('category') == $category->slug ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500 h-5 w-5 border-slate-200">
                                            <label for="cat-{{ $category->id }}" class="ms-4 text-sm text-slate-600 font-bold group-hover:text-blue-600 transition-colors">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white font-black py-4 rounded-2xl hover:bg-blue-700 transition-all shadow-xl hover:shadow-blue-500/30">
                                Appliquer
                            </button>
                            <a href="{{ route('services.index') }}" class="block text-center text-xs font-black text-slate-400 mt-6 hover:text-blue-600 transition-colors uppercase tracking-widest">Réinitialiser</a>
                        </form>
                    </div>
                </div>

                <!-- Services List Enhanced -->
                <div class="w-full lg:w-3/4">
                    <div class="mb-12 flex flex-col md:flex-row justify-between md:items-end gap-6">
                        <div>
                            <h1 class="text-5xl font-black text-slate-900 mb-4 tracking-tight">
                                @if(request('category'))
                                    {{ $categories->where('slug', request('category'))->first()->name }}
                                @else
                                    Tous les Services
                                @endif
                            </h1>
                            <p class="text-slate-500 font-medium">Découvrez les meilleurs experts près de chez vous.</p>
                        </div>
                        <div class="bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm text-sm font-black text-slate-400 uppercase tracking-widest">
                            <span class="text-blue-600">{{ $services->total() }}</span> services trouvés
                        </div>
                    </div>

                    @if($services->isEmpty())
                        <div class="bg-white p-24 rounded-[3rem] text-center shadow-sm border border-slate-100">
                            <div class="bg-slate-50 w-24 h-24 rounded-3xl flex items-center justify-center mx-auto mb-8 text-slate-200">
                                <i class="fas fa-search text-4xl"></i>
                            </div>
                            <h2 class="text-3xl font-black text-slate-900 mb-4">Aucun résultat</h2>
                            <p class="text-slate-500 font-medium max-w-md mx-auto">Nous n'avons pas trouvé de services correspondant à votre recherche. Essayez d'autres filtres.</p>
                        </div>
                    @else
                        <div class="grid md:grid-cols-2 gap-10">
                            @foreach($services as $service)
                                @php
                                    $defaultImgs = [
                                        'plomberie' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&q=80&w=600',
                                        'electricite' => 'https://images.unsplash.com/photo-1621905252507-b35242f8df49?auto=format&fit=crop&q=80&w=600',
                                        'peinture' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=600',
                                        'nettoyage' => 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=600',
                                    ];
                                    $serviceImg = $service->image ? asset('storage/' . $service->image) : ($defaultImgs[$service->category->slug] ?? 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=600');
                                @endphp
                                <div class="group bg-white rounded-[3rem] shadow-sm hover:shadow-[0_40px_80px_-15px_rgba(0,0,0,0.1)] transition-all border border-slate-100 flex flex-col h-full overflow-hidden hover:-translate-y-2">
                                    <div class="h-64 relative overflow-hidden">
                                        <img src="{{ $serviceImg }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $service->title }}">
                                        <div class="absolute top-6 left-6">
                                            <span class="bg-white/95 backdrop-blur px-4 py-2 rounded-2xl text-[10px] font-black text-blue-600 shadow-sm uppercase tracking-widest">
                                                {{ $service->category->name }}
                                            </span>
                                        </div>
                                        <div class="absolute bottom-6 right-6">
                                            <div class="bg-blue-600 text-white px-5 py-2 rounded-2xl font-black shadow-xl">
                                                {{ $service->price }} <span class="text-[10px] opacity-70">DH</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-10 flex-1 flex flex-col">
                                        <h3 class="text-2xl font-black mb-4 text-slate-800 leading-tight group-hover:text-blue-600 transition-colors">{{ $service->title }}</h3>
                                        <div class="flex items-center gap-1 mb-6 text-yellow-400 text-xs">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= round($service->averageRating()) ? '' : 'text-slate-200' }}"></i>
                                            @endfor
                                            <span class="text-slate-400 font-black ml-2 text-[10px] uppercase tracking-widest">({{ $service->reviews->count() }} avis)</span>
                                        </div>
                                        <div class="mt-auto flex items-center justify-between pt-8 border-t border-slate-50">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-black text-xs">
                                                    {{ substr($service->user->name, 0, 1) }}
                                                </div>
                                                <span class="text-sm font-black text-slate-700 line-clamp-1">{{ $service->user->name }}</span>
                                            </div>
                                            <a href="{{ route('services.show', $service) }}" class="bg-slate-900 text-white px-6 py-3 rounded-2xl text-xs font-black hover:bg-blue-600 transition-all shadow-lg active:scale-95 uppercase tracking-widest">
                                                Détails
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-20">
                            {{ $services->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
