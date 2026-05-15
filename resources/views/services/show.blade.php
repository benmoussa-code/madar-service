<x-app-layout>
    <div class="py-16 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs or back link -->
            <div class="mb-8">
                <a href="{{ route('services.index') }}" class="inline-flex items-center text-sm font-bold text-slate-400 hover:text-blue-600 transition-colors group">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Retour aux services
                </a>
            </div>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-10">
                    <!-- Hero Card -->
                    <div class="bg-white rounded-[2.5rem] shadow-[0_8px_40px_rgb(0,0,0,0.03)] border border-slate-100 overflow-hidden">
                        <div class="h-[450px] bg-slate-100 relative overflow-hidden group">
                            @php
                                $defaultImgs = [
                                    'plomberie' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&q=80&w=1200',
                                    'electricite' => 'https://images.unsplash.com/photo-1621905252507-b35242f8df49?auto=format&fit=crop&q=80&w=1200',
                                    'peinture' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=1200',
                                    'nettoyage' => 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=1200',
                                ];
                                $serviceImg = $service->image ? asset('storage/' . $service->image) : ($defaultImgs[$service->category->slug] ?? 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=1200');
                            @endphp
                            <img src="{{ $serviceImg }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="{{ $service->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute bottom-8 left-8 right-8 flex items-end justify-between">
                                <div class="space-y-4">
                                    <span class="bg-blue-600/90 backdrop-blur-md text-white px-4 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-[0.2em] shadow-lg border border-white/20">
                                        {{ $service->category->name }}
                                    </span>
                                    <h1 class="text-4xl font-black text-white tracking-tight leading-tight">{{ $service->title }}</h1>
                                </div>
                                <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-2xl text-white text-[10px] font-bold uppercase tracking-widest border border-white/10">
                                    <i class="far fa-eye mr-2"></i>{{ $service->views }} vues
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-10 md:p-14">
                            <div class="flex items-center gap-6 mb-10 pb-8 border-b border-slate-50">
                                <div class="flex items-center gap-2">
                                    <div class="flex text-yellow-400 text-xs">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= round($service->averageRating()) ? '' : 'text-slate-100' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="text-slate-900 font-bold text-sm">{{ number_format($service->averageRating(), 1) }}</span>
                                    <span class="text-slate-400 font-medium text-sm">({{ $service->reviews->count() }} avis)</span>
                                </div>
                                <div class="w-px h-4 bg-slate-100"></div>
                                <div class="flex items-center gap-2 text-slate-400 text-sm font-medium">
                                    <i class="far fa-calendar-alt"></i>
                                    Posté le {{ $service->created_at->format('d M Y') }}
                                </div>
                            </div>

                            <div class="prose prose-slate max-w-none">
                                <h3 class="text-xl font-bold text-slate-900 mb-6 uppercase tracking-widest text-[11px]">Description du service</h3>
                                <div class="text-slate-600 leading-relaxed text-lg whitespace-pre-line font-medium">
                                    {{ $service->description }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="bg-white rounded-[2.5rem] shadow-[0_8px_40px_rgb(0,0,0,0.03)] border border-slate-100 p-10 md:p-14">
                        <div class="flex items-center justify-between mb-12">
                            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Avis Clients</h2>
                            <div class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">
                                <span class="text-xl font-bold text-slate-900">{{ number_format($service->averageRating(), 1) }}</span>
                                <div class="flex text-yellow-400 text-[10px]">
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        
                        @auth
                            <form action="{{ route('reviews.store', $service) }}" method="POST" class="mb-14 bg-slate-50/50 p-8 rounded-3xl border border-slate-100/50">
                                @csrf
                                <div class="grid md:grid-cols-2 gap-8 mb-8">
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Votre note</label>
                                        <div class="flex gap-4">
                                            @for($i = 1; $i <= 5; $i++)
                                                <label class="cursor-pointer group relative">
                                                    <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                                    <i class="fas fa-star text-2xl text-slate-200 group-hover:text-yellow-400 peer-checked:text-yellow-400 transition-all hover:scale-110"></i>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-8">
                                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Commentaire</label>
                                    <textarea name="comment" rows="3" class="w-full rounded-2xl border-slate-100 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 bg-white placeholder:text-slate-300 font-medium text-sm transition-all" placeholder="Que pensez-vous de ce service ?"></textarea>
                                </div>
                                <button type="submit" class="bg-slate-900 text-white font-bold px-8 py-3.5 rounded-xl hover:bg-blue-600 transition-all shadow-xl hover:shadow-blue-500/20 active:scale-95 text-sm">
                                    Publier mon avis
                                </button>
                            </form>
                        @endauth

                        <div class="space-y-10">
                            @forelse($service->reviews as $review)
                                <div class="flex gap-6 pb-10 border-b border-slate-50 last:border-0 last:pb-0 group">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 font-bold shrink-0 text-sm uppercase shadow-inner">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex flex-col">
                                                <h4 class="font-bold text-slate-800 text-sm">{{ $review->user->name }}</h4>
                                                <div class="flex text-yellow-400 text-[8px] mt-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-slate-100' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-slate-500 leading-relaxed font-medium text-sm">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="py-12 text-center text-slate-300">
                                    <i class="far fa-comment-dots text-4xl mb-4 opacity-20"></i>
                                    <p class="text-sm font-medium">Aucun avis pour le moment.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-8">
                        <!-- Pricing Card -->
                        <div class="bg-slate-900 rounded-[2.5rem] shadow-2xl overflow-hidden text-white">
                            <div class="p-10 text-center relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-transparent"></div>
                                <div class="relative z-10">
                                    <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400 mb-2 block">Prix du service</span>
                                    <div class="text-5xl font-black text-white flex items-center justify-center gap-2">
                                        {{ number_format($service->price, 0, '.', ' ') }}
                                        <span class="text-lg text-blue-400 font-bold">DH</span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-10 pb-10 pt-4 relative z-10 space-y-4">
                                <a href="tel:{{ $service->phone ?? $service->user->phone }}" class="w-full flex items-center justify-center gap-3 bg-white text-slate-900 font-bold py-4 rounded-2xl hover:bg-blue-50 transition-all shadow-lg active:scale-95 group">
                                    <i class="fas fa-phone-alt text-sm group-hover:rotate-12 transition-transform"></i>
                                    {{ $service->phone ?? $service->user->phone ?? 'Appeler' }}
                                </a>
                                @if($service->whatsapp)
                                    <a href="https://wa.me/{{ $service->whatsapp }}" target="_blank" class="w-full flex items-center justify-center gap-3 bg-[#25D366] text-white font-bold py-4 rounded-2xl hover:bg-[#20ba59] transition-all shadow-xl shadow-green-500/20 active:scale-95">
                                        <i class="fab fa-whatsapp text-xl"></i>
                                        WhatsApp
                                    </a>
                                @endif
                                @if($service->user->address || $service->user->city)
                                    <div class="mt-4 pt-4 border-t border-slate-700/50 flex flex-col gap-2 text-slate-300 text-sm">
                                        <div class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-1">Localisation</div>
                                        <div class="flex items-start gap-3">
                                            <i class="fas fa-map-marker-alt text-blue-400 mt-1"></i>
                                            <span class="leading-snug">
                                                {{ $service->user->address ?? '' }}<br>
                                                {{ $service->user->city ?? '' }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Provider Card -->
                        <div class="bg-white rounded-[2.5rem] shadow-[0_8px_40px_rgb(0,0,0,0.03)] border border-slate-100 p-8">
                            <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-6">Prestataire</h3>
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100 border border-slate-100 flex items-center justify-center text-slate-600 text-xl font-bold shadow-inner uppercase">
                                    {{ substr($service->user->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="font-bold text-slate-900 text-base leading-tight">{{ $service->user->name }}</h4>
                                    <div class="flex items-center gap-1.5 text-green-500 text-[10px] font-bold uppercase tracking-widest mt-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                        Vérifié
                                    </div>
                                </div>
                            </div>
                            
                            @auth
                                <form action="{{ route('messages.store') }}" method="POST" class="space-y-4 pt-6 border-t border-slate-50">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $service->user_id }}">
                                    <textarea name="content" rows="3" required class="w-full rounded-2xl border-slate-100 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 bg-slate-50 text-sm placeholder:text-slate-400 font-medium transition-all" placeholder="Envoyer un message..."></textarea>
                                    <button type="submit" class="w-full flex items-center justify-center gap-3 bg-slate-50 text-slate-600 hover:bg-blue-600 hover:text-white font-bold py-3.5 rounded-xl transition-all active:scale-95 text-sm">
                                        <i class="far fa-paper-plane text-xs"></i>
                                        Envoyer le message
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block text-center bg-slate-50 text-slate-500 font-bold py-4 rounded-2xl hover:bg-slate-100 transition-all text-xs uppercase tracking-widest">
                                    Connectez-vous pour contacter
                                </a>
                            @endauth
                        </div>

                        <!-- Mini Stats -->
                        <div class="bg-white rounded-[2.5rem] shadow-[0_8px_40px_rgb(0,0,0,0.03)] border border-slate-100 p-8 grid grid-cols-2 gap-4">
                            <div class="text-center p-4 bg-slate-50 rounded-2xl border border-slate-100/50">
                                <div class="text-2xl font-black text-slate-900 mb-1">{{ $service->views }}</div>
                                <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Vues</div>
                            </div>
                            <div class="text-center p-4 bg-slate-50 rounded-2xl border border-slate-100/50">
                                <div class="text-2xl font-black text-slate-900 mb-1">{{ $service->reviews->count() }}</div>
                                <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Avis</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
