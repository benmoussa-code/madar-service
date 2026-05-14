<x-app-layout>
    <div class="py-6 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section Enhanced -->
            <div class="relative rounded-[40px] p-12 md:p-20 text-white mb-20 shadow-2xl overflow-hidden bg-slate-900">
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=1600" class="w-full h-full object-cover opacity-30" alt="Hero background">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-indigo-900/80 to-slate-900/90"></div>
                </div>

                <div class="relative z-10 grid lg:grid-cols-2 gap-12 items-center">
                    <div class="animate-float-slow">
                        <span class="inline-block px-4 py-2 bg-blue-500/20 backdrop-blur-xl border border-blue-400/30 rounded-full text-blue-300 text-sm font-bold mb-6 tracking-widest uppercase">Expertise & Confiance</span>
                        <h1 class="text-6xl md:text-7xl font-black mb-8 leading-[1.1] tracking-tight">
                            Des Experts <br><span class="text-blue-400">Locaux</span> à votre <span class="underline decoration-blue-500/50">Service</span>
                        </h1>
                        <p class="text-xl mb-10 opacity-80 max-w-xl font-medium leading-relaxed">
                            Plomberie, électricité, nettoyage et bien plus encore. Trouvez le professionnel idéal en un clic.
                        </p>
                        <form action="{{ route('services.index') }}" method="GET" class="flex p-2 glass rounded-3xl max-w-xl group focus-within:ring-4 focus-within:ring-blue-500/20 transition-all">
                            <input type="text" name="search" placeholder="Quel service recherchez-vous ?" class="flex-1 bg-transparent border-none focus:ring-0 text-slate-900 px-6 py-4 placeholder:text-slate-400 text-lg">
                            <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black hover:bg-blue-700 transition-all shadow-xl hover:shadow-blue-500/40 active:scale-95">
                                Rechercher
                            </button>
                        </form>
                    </div>
                    <div class="hidden lg:block relative">
                        <div class="animate-float relative z-10">
                            <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=800" class="rounded-[3rem] shadow-2xl border-4 border-white/10" alt="Professional worker">
                        </div>
                        <div class="absolute -bottom-10 -left-10 glass p-6 rounded-3xl shadow-xl animate-float" style="animation-delay: -2s">
                            <div class="flex items-center gap-4">
                                <div class="bg-green-100 text-green-600 p-3 rounded-2xl">
                                    <i class="fas fa-check-circle text-2xl"></i>
                                </div>
                                <div>
                                    <div class="text-slate-900 font-black text-xl">+1000</div>
                                    <div class="text-slate-500 text-sm font-bold uppercase tracking-wider">Services Réussis</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Section Enhanced -->
            <div class="mb-24">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Parcourez par Catégories</h2>
                    <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                    @php
                        $icons = [
                            'plomberie' => ['icon' => 'wrench', 'img' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&q=80&w=300'],
                            'electricite' => ['icon' => 'bolt', 'img' => 'https://images.unsplash.com/photo-1621905252507-b35242f8df49?auto=format&fit=crop&q=80&w=300'],
                            'peinture' => ['icon' => 'paint-brush', 'img' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=300'],
                            'nettoyage' => ['icon' => 'broom', 'img' => 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=300'],
                            'climatisation' => ['icon' => 'snowflake', 'img' => 'https://images.unsplash.com/photo-1631541486121-69e0004ccf4f?auto=format&fit=crop&q=80&w=300'],
                            'menuiserie' => ['icon' => 'hammer', 'img' => 'https://images.unsplash.com/photo-1533090161767-e6ffed986c88?auto=format&fit=crop&q=80&w=300'],
                        ];
                    @endphp
                    @foreach($categories as $category)
                        <a href="{{ route('services.index', ['category' => $category->slug]) }}" class="group relative bg-white h-48 rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all hover:-translate-y-2 border border-slate-100">
                            <img src="{{ $icons[$category->slug]['img'] ?? 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=300' }}" class="absolute inset-0 w-full h-full object-cover opacity-10 group-hover:opacity-20 transition-opacity" alt="{{ $category->name }}">
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-6">
                                <div class="bg-blue-50 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-all transform group-hover:rotate-12">
                                    <i class="fas fa-{{ $icons[$category->slug]['icon'] ?? 'star' }} text-2xl"></i>
                                </div>
                                <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">{{ $category->name }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Latest Services Section Enhanced -->
            <div>
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Services à la Une</h2>
                        <p class="text-slate-500 font-medium">Les prestataires les mieux notés de la semaine.</p>
                    </div>
                    <a href="{{ route('services.index') }}" class="group bg-white px-8 py-4 rounded-2xl text-blue-600 font-black shadow-sm hover:shadow-xl transition-all flex items-center gap-3 border border-slate-100">
                        Voir tout <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                <div class="grid md:grid-cols-3 gap-10">
                    @foreach($latestServices as $service)
                        @php
                            $defaultImgs = [
                                'plomberie' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&q=80&w=600',
                                'electricite' => 'https://images.unsplash.com/photo-1621905252507-b35242f8df49?auto=format&fit=crop&q=80&w=600',
                                'peinture' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=600',
                                'nettoyage' => 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=600',
                            ];
                            $serviceImg = $service->image ? asset('storage/' . $service->image) : ($defaultImgs[$service->category->slug] ?? 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=600');
                        @endphp
                        <div class="group bg-white rounded-[3rem] shadow-sm hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] transition-all border border-slate-100 flex flex-col h-full overflow-hidden">
                            <div class="h-64 relative overflow-hidden">
                                <img src="{{ $serviceImg }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $service->title }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <div class="absolute top-6 left-6">
                                    <span class="bg-white/95 backdrop-blur px-4 py-2 rounded-2xl text-xs font-black text-blue-600 shadow-sm uppercase tracking-widest">
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
                                <p class="text-slate-500 font-medium mb-8 line-clamp-2 leading-relaxed">{{ $service->description }}</p>
                                
                                <div class="mt-auto flex items-center justify-between pt-8 border-t border-slate-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-black">
                                            {{ substr($service->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-black text-slate-800">{{ $service->user->name }}</div>
                                            <div class="flex text-yellow-400 text-[10px]">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('services.show', $service) }}" class="bg-slate-900 text-white w-12 h-12 rounded-2xl flex items-center justify-center hover:bg-blue-600 transition-all shadow-lg active:scale-90">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }
    </style>
</x-app-layout>
