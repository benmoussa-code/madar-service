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
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Utilisateurs Totaux</div>
                    <div class="text-3xl font-black text-slate-900 group-hover:text-blue-600 transition-colors">{{ number_format($stats['total_users'], 0, '.', ' ') }}</div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 group hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Prestataires</div>
                    <div class="text-3xl font-black text-slate-900 group-hover:text-indigo-600 transition-colors">{{ number_format($stats['total_providers'], 0, '.', ' ') }}</div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 group hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-500 relative overflow-hidden">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Satisfaction Clients</div>
                    <div class="flex items-center gap-2">
                        <div class="text-3xl font-black text-emerald-600">{{ number_format($stats['avg_satisfaction'], 1) }}</div>
                        <div class="flex text-yellow-400 text-xs">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= round($stats['avg_satisfaction']) ? '' : 'text-slate-100' }}"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 group hover:shadow-xl hover:shadow-yellow-500/5 transition-all duration-500 relative overflow-hidden">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Validation Services</div>
                    <div class="text-3xl font-black text-yellow-600">{{ number_format($stats['pending_services'], 0, '.', ' ') }}</div>
                    <div class="absolute top-0 right-0 w-1 h-full bg-yellow-400"></div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid lg:grid-cols-2 gap-10">
                <!-- User Management -->
                <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <h2 class="text-lg font-bold text-slate-800">Gestion des Comptes</h2>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Derniers inscrits</span>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @foreach($users as $user)
                            <div class="p-6 flex items-center justify-between hover:bg-slate-50/50 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold uppercase text-[10px] border border-slate-200">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        @if($user->role === 'provider')
                                            <a href="{{ route('admin.providers.show', $user) }}" class="font-bold text-slate-800 text-sm truncate hover:text-blue-600 transition-colors">{{ $user->name }}</a>
                                        @else
                                            <div class="font-bold text-slate-800 text-sm truncate">{{ $user->name }}</div>
                                        @endif
                                        <div class="text-[9px] font-bold uppercase tracking-widest {{ $user->role === 'provider' ? 'text-blue-500' : 'text-slate-400' }}">
                                            {{ $user->role === 'provider' ? 'Prestataire' : 'Client' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[9px] text-slate-400 font-medium">{{ $user->created_at->format('d/m/Y') }}</span>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce compte ? Cette action est irréversible.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 bg-red-50 text-red-400 rounded-lg hover:bg-red-600 hover:text-white transition-all flex items-center justify-center active:scale-90">
                                            <i class="fas fa-trash text-[10px]"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Services Validation -->
                <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <h2 class="text-lg font-bold text-slate-800">Services en Attente</h2>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Validation requise</span>
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
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.services.status', $service) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="bg-green-600 text-white text-[9px] font-bold px-3 py-1.5 rounded-lg hover:bg-slate-900 transition-all uppercase tracking-widest">Approuver</button>
                                    </form>
                                    <form action="{{ route('admin.services.status', $service) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="bg-slate-100 text-slate-400 text-[9px] font-bold px-3 py-1.5 rounded-lg hover:bg-red-600 hover:text-white transition-all uppercase tracking-widest">Rejeter</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center text-slate-300">
                                <p class="text-[10px] font-bold uppercase tracking-widest">Aucun service en attente</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Announcements -->
            <div class="mt-10">
                <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <h2 class="text-lg font-bold text-slate-800">Dernières Annonces Clients</h2>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Surveillance du contenu</span>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse($recentAnnouncements as $announcement)
                            <div class="p-6 flex items-center justify-between hover:bg-slate-50/50 transition-all group">
                                <div class="flex items-center gap-4">
                                    @if($announcement->image)
                                        <div class="w-10 h-10 rounded-xl overflow-hidden border border-slate-100 shrink-0">
                                            <img src="{{ asset('storage/' . $announcement->image) }}" class="w-full h-full object-cover" alt="Thumb">
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500 border border-indigo-100">
                                            <i class="fas fa-bullhorn text-sm"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="font-bold text-slate-800 text-sm truncate">{{ $announcement->title }}</div>
                                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Par {{ $announcement->user->name }} • {{ $announcement->category->name }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6">
                                    <p class="hidden md:block text-xs text-slate-500 max-w-md truncate">{{ $announcement->description }}</p>
                                    <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Voulez-vous supprimer cette annonce ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 bg-slate-50 text-slate-300 rounded-lg hover:bg-red-600 hover:text-white transition-all flex items-center justify-center active:scale-90">
                                            <i class="fas fa-trash text-[10px]"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center text-slate-300">
                                <p class="text-[10px] font-bold uppercase tracking-widest">Aucune annonce récente</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>
