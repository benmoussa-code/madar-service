<x-app-layout>
    <div class="py-10 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="relative rounded-[3rem] p-12 md:p-24 text-white mb-24 shadow-2xl overflow-hidden bg-slate-900">
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=1600" class="w-full h-full object-cover opacity-20" alt="Hero background">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-slate-900/80 to-slate-900/90"></div>
                </div>

                <div class="relative z-10 grid lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-8">
                        <div class="inline-flex items-center px-4 py-2 bg-blue-500/10 backdrop-blur-xl border border-blue-400/20 rounded-xl text-blue-400 text-[10px] font-bold tracking-[0.2em] uppercase">
                            {{ __('Plateforme n°1 au Maroc') }}
                        </div>
                        <h1 class="text-6xl md:text-7xl font-black mb-6 leading-[1.05] tracking-tight">
                            {{ __("L'excellence à votre") }} <span class="text-blue-500">{{ __('Service') }}</span>
                        </h1>
                        <p class="text-lg opacity-70 max-w-lg font-medium leading-relaxed">
                            {{ __('Trouvez instantanément les meilleurs prestataires vérifiés pour tous vos besoins du quotidien.') }}
                        </p>
                        
                        <form action="{{ route('services.index') }}" method="GET" class="flex p-1.5 bg-white rounded-[2rem] max-w-xl shadow-2xl group focus-within:ring-4 focus-within:ring-blue-500/10 transition-all">
                            <div class="flex-1 flex items-center px-6">
                                <i class="fas fa-search text-slate-300 mr-3"></i>
                                <input type="text" name="search" placeholder="{{ __('Que recherchez-vous ?') }}" class="w-full bg-transparent border-none focus:ring-0 text-slate-900 placeholder:text-slate-400 text-sm font-medium py-4">
                            </div>
                            <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-[1.5rem] font-bold hover:bg-slate-900 transition-all active:scale-95 text-sm">
                                {{ __('Rechercher') }}
                            </button>
                        </form>
                    </div>

                    <div class="hidden lg:block relative">
                        <div class="animate-float relative z-10">
                            <div class="absolute -inset-4 bg-blue-600/20 blur-3xl rounded-full"></div>
                            <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=800" class="rounded-[3rem] shadow-2xl border border-white/10 relative z-10" alt="Worker">
                        </div>
                        
                        <!-- Floating Stats Card -->
                        <div class="absolute -bottom-10 -left-10 bg-white/90 backdrop-blur-xl p-6 rounded-3xl shadow-2xl border border-white/50 animate-float-delayed">
                            <div class="flex items-center gap-4">
                                <div class="bg-blue-600 text-white w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-lg shadow-blue-500/20">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <div class="text-slate-900 font-black text-xl leading-none">100%</div>
                                    <div class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-1">{{ __('Vérifié & Sécurisé') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="mb-32">
                <div class="flex flex-col items-center text-center mb-16 space-y-4">
                    <span class="text-blue-600 font-bold text-[10px] uppercase tracking-[0.3em]">{{ __("Domaines d'expertise") }}</span>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight">{{ __('Catégories Populaires') }}</h2>
                    <div class="w-12 h-1 bg-slate-200 rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    @php
                        $catDetails = [
                            'plomberie' => ['icon' => 'wrench', 'img' => 'https://images.pexels.com/photos/6419128/pexels-photo-6419128.jpeg?auto=compress&cs=tinysrgb&w=800'],
                            'electricite' => ['icon' => 'bolt', 'img' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=800&auto=format&fit=crop'],
                            'peinture' => ['icon' => 'paint-brush', 'img' => 'https://images.pexels.com/photos/1669754/pexels-photo-1669754.jpeg?auto=compress&cs=tinysrgb&w=800'],
                            'nettoyage' => ['icon' => 'broom', 'img' => 'https://images.pexels.com/photos/6195125/pexels-photo-6195125.jpeg?auto=compress&cs=tinysrgb&w=800'],
                            'climatisation' => ['icon' => 'snowflake', 'img' => 'https://images.pexels.com/photos/3680319/pexels-photo-3680319.jpeg?auto=compress&cs=tinysrgb&w=800'],
                            'menuiserie' => ['icon' => 'hammer', 'img' => 'https://images.pexels.com/photos/1750059/pexels-photo-1750059.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ];
                    @endphp
                    @foreach($categories as $category)
                        @php 
                            $cfg = $catDetails[$category->slug] ?? ['icon' => 'star', 'img' => 'https://images.pexels.com/photos/443383/pexels-photo-443383.jpeg?auto=compress&cs=tinysrgb&w=800'];
                            $catImg = $cfg['img'];
                        @endphp
                        <a href="{{ route('services.index', ['category' => $category->slug]) }}" 
                           class="group relative h-56 rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-slate-100 bg-slate-900">
                            <img src="{{ $catImg }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-700" alt="{{ $category->name }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-6 space-y-3">
                                <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center text-white border border-white/20 group-hover:bg-blue-600 group-hover:border-blue-500 transition-all">
                                    <i class="fas fa-{{ $cfg['icon'] }} text-xl"></i>
                                </div>
                                <h3 class="font-black text-white text-[10px] uppercase tracking-[0.2em] text-center">{{ __($category->name) }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Featured Services -->
            <div class="mb-20">
                <div class="flex justify-between items-end mb-12">
                    <div class="space-y-2">
                        <span class="text-blue-600 font-bold text-[10px] uppercase tracking-[0.3em]">{{ __('Qualité garantie') }}</span>
                        <h2 class="text-4xl font-black text-slate-900 tracking-tight">{{ __('Services à la Une') }}</h2>
                    </div>
                    <a href="{{ route('services.index') }}" class="group inline-flex items-center text-sm font-bold text-slate-400 hover:text-blue-600 transition-colors">
                        {{ __('Voir tout le catalogue') }}
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($latestServices as $service)
                        @php
                            $defaultImgs = [
                                'plomberie' => 'https://images.pexels.com/photos/6419128/pexels-photo-6419128.jpeg?auto=compress&cs=tinysrgb&w=800',
                                'electricite' => 'https://images.pexels.com/photos/257736/pexels-photo-257736.jpeg?auto=compress&cs=tinysrgb&w=800',
                                'peinture' => 'https://images.pexels.com/photos/1669754/pexels-photo-1669754.jpeg?auto=compress&cs=tinysrgb&w=800',
                                'nettoyage' => 'https://images.pexels.com/photos/6195125/pexels-photo-6195125.jpeg?auto=compress&cs=tinysrgb&w=800',
                                'climatisation' => 'https://images.pexels.com/photos/3680319/pexels-photo-3680319.jpeg?auto=compress&cs=tinysrgb&w=800',
                                'menuiserie' => 'https://images.pexels.com/photos/1750059/pexels-photo-1750059.jpeg?auto=compress&cs=tinysrgb&w=800',
                            ];
                            
                            $rawImg = trim($service->image ?? '');
                            if ($rawImg && (str_starts_with($rawImg, 'http') || str_starts_with($rawImg, '//'))) {
                                $serviceImg = $rawImg;
                            } elseif ($rawImg) {
                                $serviceImg = asset('storage/' . $rawImg);
                            } else {
                                $serviceImg = $defaultImgs[$service->category->slug] ?? 'https://images.pexels.com/photos/443383/pexels-photo-443383.jpeg?auto=compress&cs=tinysrgb&w=800';
                            }
                        @endphp
                        <div class="group bg-white rounded-[2.5rem] shadow-[0_4px_20px_rgb(0,0,0,0.02)] hover:shadow-[0_25px_60px_rgba(0,0,0,0.08)] transition-all duration-500 border border-slate-100 flex flex-col h-full overflow-hidden hover:-translate-y-2">
                            <div class="h-64 relative overflow-hidden">
                                <img src="{{ $serviceImg }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $service->title }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <div class="absolute top-6 left-6">
                                    <span class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl text-[10px] font-bold text-blue-600 shadow-sm uppercase tracking-widest border border-white/20">
                                        {{ __($service->category->name) }}
                                    </span>
                                </div>
                                <div class="absolute bottom-6 right-6">
                                    <a href="{{ route('services.show', $service) }}" class="bg-blue-600 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-lg shadow-blue-500/20 hover:bg-slate-900 transition-colors">
                                        {{ __('Détails') }}
                                    </a>
                                </div>
                            </div>
                            <div class="p-8 flex-1 flex flex-col">
                                <h3 class="text-xl font-bold mb-3 text-slate-800 leading-snug group-hover:text-blue-600 transition-colors">
                                    {{ __($service->title) }}
                                </h3>
                                <p class="text-slate-400 text-sm font-medium mb-8 line-clamp-2 leading-relaxed">{{ __($service->description) }}</p>
                                
                                <div class="mt-auto flex items-center pt-6 border-t border-slate-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 font-bold text-[10px] shadow-inner uppercase">
                                            {{ substr($service->user->name, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider leading-none mb-1">Expert</span>
                                            <span class="text-xs font-bold text-slate-800 leading-none truncate w-32">{{ $service->user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float 6s ease-in-out infinite; animation-delay: -3s; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>
</x-app-layout>
