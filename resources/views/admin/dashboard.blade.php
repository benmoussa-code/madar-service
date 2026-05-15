<x-app-layout>
    <div class="py-16 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 space-y-1">
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Admin Dashboard</h1>
                <p class="text-slate-400 text-sm font-medium">Surveillance et gestion globale de la plateforme.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 group hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-500">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Utilisateurs</div>
                    <div class="text-3xl font-black text-slate-900 group-hover:text-blue-600 transition-colors">{{ number_format($stats['users'], 0, '.', ' ') }}</div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 group hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Services</div>
                    <div class="text-3xl font-black text-slate-900 group-hover:text-indigo-600 transition-colors">{{ number_format($stats['services'], 0, '.', ' ') }}</div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 group hover:shadow-xl hover:shadow-yellow-500/5 transition-all duration-500 relative overflow-hidden">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">En Attente</div>
                    <div class="text-3xl font-black text-yellow-600">{{ number_format($stats['pending_services'], 0, '.', ' ') }}</div>
                    <div class="absolute top-0 right-0 w-1 h-full bg-yellow-400"></div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 group hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-500">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Avis</div>
                    <div class="text-3xl font-black text-slate-900 group-hover:text-emerald-600 transition-colors">{{ number_format($stats['reviews'], 0, '.', ' ') }}</div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid lg:grid-cols-2 gap-10">
                <!-- Recent Services -->
                <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <h2 class="text-lg font-bold text-slate-800">Services Récents</h2>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Dernières soumissions</span>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse($recentServices as $service)
                            <div class="p-6 flex items-center justify-between hover:bg-slate-50/50 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden shrink-0 border border-slate-100 group-hover:border-blue-200 transition-colors">
                                        @if($service->image)
                                            <img src="{{ str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <i class="fas fa-image text-sm"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-bold text-slate-800 text-sm truncate group-hover:text-blue-600 transition-colors">{{ $service->title }}</div>
                                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Par {{ $service->user->name }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 shrink-0">
                                    <span class="text-[9px] font-bold uppercase py-1 px-2.5 rounded-lg border {{ $service->status === 'approved' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-yellow-50 text-yellow-600 border-yellow-100' }}">
                                        {{ $service->status === 'approved' ? 'Approuvé' : 'Attente' }}
                                    </span>
                                    <div class="flex gap-1.5">
                                        <form action="{{ route('admin.services.status', $service) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="w-8 h-8 bg-slate-50 text-slate-400 rounded-lg hover:bg-green-600 hover:text-white transition-all flex items-center justify-center active:scale-90 shadow-sm" title="Approuver">
                                                <i class="fas fa-check text-[10px]"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.services.status', $service) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-8 h-8 bg-slate-50 text-slate-400 rounded-lg hover:bg-red-600 hover:text-white transition-all flex items-center justify-center active:scale-90 shadow-sm" title="Rejeter">
                                                <i class="fas fa-times text-[10px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center text-slate-300">
                                <p class="text-sm font-medium">Aucun service en attente.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Fast Links -->
                <div class="space-y-8">
                    <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden group cursor-pointer">
                        <div class="relative z-10">
                            <h2 class="text-2xl font-black mb-3 tracking-tight">Gestion Utilisateurs</h2>
                            <p class="text-slate-400 text-sm font-medium mb-8 leading-relaxed">Gérez les comptes clients et prestataires en toute sécurité.</p>
                            <a href="{{ route('admin.users') }}" class="inline-flex items-center bg-white text-slate-900 font-bold px-6 py-3 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-lg text-xs uppercase tracking-widest active:scale-95">
                                Gérer les comptes
                                <i class="fas fa-chevron-right ml-2 text-[10px]"></i>
                            </a>
                        </div>
                        <i class="fas fa-users absolute -bottom-8 -right-8 text-[12rem] opacity-[0.03] group-hover:scale-110 transition-transform duration-700"></i>
                    </div>

                    <div class="bg-blue-600 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden group cursor-pointer">
                        <div class="relative z-10">
                            <h2 class="text-2xl font-black mb-3 tracking-tight">Catégories</h2>
                            <p class="text-blue-100 text-sm font-medium mb-8 leading-relaxed">Organisez les services par thématiques pertinentes.</p>
                            <a href="{{ route('admin.categories') }}" class="inline-flex items-center bg-white text-blue-600 font-bold px-6 py-3 rounded-xl hover:bg-slate-900 hover:text-white transition-all shadow-lg text-xs uppercase tracking-widest active:scale-95">
                                Gérer les thèmes
                                <i class="fas fa-chevron-right ml-2 text-[10px]"></i>
                            </a>
                        </div>
                        <i class="fas fa-tags absolute -bottom-8 -right-8 text-[12rem] opacity-[0.1] group-hover:scale-110 transition-transform duration-700"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>p-layout>
