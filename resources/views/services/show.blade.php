<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Main Content Enhanced -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden mb-12">
                        <div class="h-[500px] bg-slate-100 relative group">
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
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                            <div class="absolute bottom-10 left-10 right-10 flex items-center justify-between">
                                <span class="bg-blue-600 text-white px-6 py-2 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl">
                                    {{ $service->category->name }}
                                </span>
                                <div class="flex gap-4">
                                    <div class="bg-white/20 backdrop-blur-md px-4 py-2 rounded-2xl text-white text-xs font-black">
                                        <i class="far fa-eye mr-2"></i>{{ $service->views }} vues
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-12 md:p-16">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="flex text-yellow-400 text-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= round($service->averageRating()) ? '' : 'text-slate-100' }}"></i>
                                    @endfor
                                </div>
                                <span class="text-slate-400 font-black text-xs uppercase tracking-widest">Posté le {{ $service->created_at->format('d M Y') }}</span>
                            </div>
                            <h1 class="text-5xl font-black text-slate-900 mb-8 tracking-tight leading-tight">{{ $service->title }}</h1>
                            <div class="prose prose-slate max-w-none text-slate-600 mb-12 leading-relaxed text-xl font-medium">
                                {{ $service->description }}
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section Enhanced -->
                    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 p-12 md:p-16">
                        <div class="flex items-center justify-between mb-12">
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Avis Clients <span class="text-blue-600 text-lg ml-2">({{ $service->reviews->count() }})</span></h2>
                            <div class="flex items-center gap-2">
                                <span class="text-3xl font-black text-slate-900">{{ number_format($service->averageRating(), 1) }}</span>
                                <i class="fas fa-star text-yellow-400"></i>
                            </div>
                        </div>
                        
                        @auth
                            <form action="{{ route('reviews.store', $service) }}" method="POST" class="mb-16 bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100">
                                @csrf
                                <div class="mb-8">
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Votre note</label>
                                    <div class="flex gap-6">
                                        @for($i = 1; $i <= 5; $i++)
                                            <label class="cursor-pointer group relative">
                                                <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                                <i class="fas fa-star text-3xl text-slate-200 group-hover:text-yellow-400 peer-checked:text-yellow-400 transition-colors"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="mb-8">
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Commentaire</label>
                                    <textarea name="comment" rows="4" class="w-full rounded-2xl border-slate-200 focus:ring-blue-500 focus:border-blue-500 bg-white placeholder:text-slate-300 font-medium" placeholder="Partagez votre expérience avec ce professionnel..."></textarea>
                                </div>
                                <button type="submit" class="bg-blue-600 text-white font-black px-10 py-4 rounded-2xl hover:bg-blue-700 transition-all shadow-xl hover:shadow-blue-500/30">
                                    Publier mon avis
                                </button>
                            </form>
                        @endauth

                        <div class="space-y-12">
                            @foreach($service->reviews as $review)
                                <div class="flex gap-8 pb-12 border-b border-slate-50 last:border-0 last:pb-0">
                                    <div class="w-16 h-16 rounded-[1.5rem] bg-slate-100 flex items-center justify-center text-slate-400 font-black shrink-0 text-xl uppercase">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center gap-4">
                                                <h4 class="font-black text-slate-800 text-lg">{{ $review->user->name }}</h4>
                                                <div class="flex text-yellow-400 text-[10px]">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-slate-100' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <span class="text-xs text-slate-400 font-black uppercase tracking-widest">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-slate-500 leading-relaxed font-medium text-lg">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sidebar / Contact Enhanced -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-10">
                        <div class="bg-white rounded-[3rem] shadow-2xl border border-slate-100 overflow-hidden">
                            <div class="p-10 bg-slate-900 text-center relative overflow-hidden">
                                <div class="relative z-10">
                                    <div class="text-slate-400 text-xs font-black uppercase tracking-widest mb-2">À partir de</div>
                                    <div class="text-5xl font-black text-white">{{ $service->price }} <span class="text-xl text-blue-400">DH</span></div>
                                </div>
                                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600 rounded-full opacity-20"></div>
                            </div>
                            <div class="p-12">
                                <div class="flex items-center gap-5 mb-10 p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
                                    <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-blue-600 text-2xl font-black uppercase">
                                        {{ substr($service->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-black text-slate-800 text-lg leading-none mb-2">{{ $service->user->name }}</h3>
                                        <span class="flex items-center gap-1.5 text-green-500 text-xs font-black uppercase tracking-widest">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Vérifié
                                        </span>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <a href="tel:{{ $service->phone ?? $service->user->phone }}" class="w-full flex items-center justify-center gap-4 bg-white border-2 border-slate-900 text-slate-900 font-black py-5 rounded-3xl hover:bg-slate-900 hover:text-white transition-all shadow-sm group">
                                        <i class="fas fa-phone-alt group-hover:rotate-12 transition-transform"></i>
                                        {{ $service->phone ?? $service->user->phone ?? 'Appeler' }}
                                    </a>
                                    @if($service->whatsapp)
                                        <a href="https://wa.me/{{ $service->whatsapp }}" target="_blank" class="w-full flex items-center justify-center gap-4 bg-green-500 text-white font-black py-5 rounded-3xl hover:bg-green-600 transition-all shadow-xl shadow-green-500/30">
                                            <i class="fab fa-whatsapp text-2xl"></i>
                                            WhatsApp
                                        </a>
                                    @endif
                                    @auth
                                        <form action="{{ route('messages.store') }}" method="POST" class="mt-8 pt-8 border-t border-slate-100">
                                            @csrf
                                            <input type="hidden" name="receiver_id" value="{{ $service->user_id }}">
                                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Envoyer un message</label>
                                            <textarea name="content" rows="3" required class="w-full rounded-2xl border-slate-200 focus:ring-blue-500 focus:border-blue-500 bg-slate-50 text-sm mb-4" placeholder="Bonjour, je suis intéressé par votre service..."></textarea>
                                            <button type="submit" class="w-full flex items-center justify-center gap-4 bg-slate-900 text-white font-black py-4 rounded-2xl hover:bg-black transition-all shadow-xl">
                                                <i class="far fa-paper-plane"></i>
                                                Envoyer
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-4 bg-slate-900 text-white font-black py-4 rounded-2xl hover:bg-black transition-all shadow-xl">
                                            <i class="far fa-envelope"></i>
                                            Connectez-vous pour envoyer un message
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>

                        <!-- Stats Card Enhanced -->
                        <div class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-[3rem] p-10 text-white shadow-2xl relative overflow-hidden">
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="text-xs font-black uppercase tracking-widest opacity-70 mb-8">Performance du service</div>
                                <div class="grid grid-cols-2 gap-8 w-full">
                                    <div class="text-center">
                                        <div class="text-4xl font-black mb-1">{{ $service->views }}</div>
                                        <div class="text-[10px] uppercase font-black opacity-60 tracking-widest">Vues</div>
                                    </div>
                                    <div class="text-center border-l border-white/10">
                                        <div class="text-4xl font-black mb-1">{{ $service->reviews->count() }}</div>
                                        <div class="text-[10px] uppercase font-black opacity-60 tracking-widest">Avis</div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
