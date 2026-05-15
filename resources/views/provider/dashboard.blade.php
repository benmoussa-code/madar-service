<x-app-layout>
    <div class="py-16 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
                <div class="space-y-1">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Tableau de bord</h1>
                    <p class="text-slate-400 text-sm font-medium">Gérez vos services et suivez vos performances en temps réel.</p>
                </div>
                <a href="{{ route('provider.services.create') }}" class="group bg-blue-600 text-white font-bold px-8 py-4 rounded-2xl hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/20 flex items-center gap-3 active:scale-95">
                    <div class="bg-white/20 p-1.5 rounded-lg group-hover:bg-blue-500/30 transition-colors">
                        <i class="fas fa-plus text-xs"></i>
                    </div>
                    Ajouter un service
                </a>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 flex items-center gap-6 group hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-500">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Services actifs</div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['total_services'] }}</div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 flex items-center gap-6 group hover:shadow-xl hover:shadow-purple-500/5 transition-all duration-500">
                    <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Vues totales</div>
                        <div class="text-3xl font-black text-slate-900">{{ number_format($stats['total_views'], 0, '.', ' ') }}</div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 flex items-center gap-6 group hover:shadow-xl hover:shadow-yellow-500/5 transition-all duration-500">
                    <div class="w-16 h-16 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Avis clients</div>
                        <div class="text-3xl font-black text-slate-900">{{ $stats['total_reviews'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-3 gap-10">
                <!-- Services Table -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                        <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                            <h2 class="text-lg font-bold text-slate-800">Mes Services</h2>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Liste complète</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/50 text-slate-400 uppercase text-[10px] font-bold tracking-[0.2em]">
                                    <tr>
                                        <th class="px-8 py-5">Service</th>
                                        <th class="px-8 py-5">Catégorie</th>
                                        <th class="px-8 py-5">Statut</th>
                                        <th class="px-8 py-5 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($services as $service)
                                        <tr class="group hover:bg-slate-50/50 transition-colors">
                                            <td class="px-8 py-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-100 group-hover:border-blue-200 transition-colors">
                                                        @if($service->image)
                                                            <img src="{{ str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                        @else
                                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                                <i class="fas fa-image text-xl"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-slate-800 text-sm group-hover:text-blue-600 transition-colors">{{ $service->title }}</div>
                                                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1">
                                                            <i class="far fa-eye mr-1"></i>{{ $service->views }} vues
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-blue-100">
                                                    {{ $service->category->name }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-6">
                                                <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $service->status === 'approved' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-yellow-50 text-yellow-600 border border-yellow-100' }}">
                                                    <span class="w-1 h-1 rounded-full {{ $service->status === 'approved' ? 'bg-green-600' : 'bg-yellow-600' }}"></span>
                                                    {{ $service->status === 'approved' ? 'Approuvé' : 'En attente' }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-6 text-right">
                                                <div class="flex justify-end gap-2">
                                                    <a href="{{ route('services.show', $service) }}" class="w-9 h-9 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all shadow-sm" title="Voir">
                                                        <i class="fas fa-eye text-xs"></i>
                                                    </a>
                                                    <a href="{{ route('provider.services.edit', $service) }}" class="w-9 h-9 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="Modifier">
                                                        <i class="fas fa-edit text-xs"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Messages Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 overflow-hidden flex flex-col h-[700px]">
                        <div class="p-8 border-b border-slate-50 flex items-center justify-between shrink-0">
                            <h2 class="text-lg font-bold text-slate-800">Messages</h2>
                            <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded-lg shadow-lg shadow-blue-500/20">{{ $messages->count() }}</span>
                        </div>
                        <div class="flex-1 overflow-y-auto custom-scrollbar">
                            @forelse($messages as $message)
                                <div class="p-6 hover:bg-slate-50 transition-colors border-b border-slate-50/50 last:border-0 group cursor-pointer">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-600 text-xs font-bold uppercase shadow-inner group-hover:from-blue-500 group-hover:to-blue-600 group-hover:text-white transition-all">
                                            {{ substr($message->sender->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-slate-800 truncate">{{ $message->sender->name }}</div>
                                            <div class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">{{ $message->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 group-hover:text-slate-700 transition-colors">{{ $message->content }}</p>
                                </div>
                            @empty
                                <div class="h-full flex flex-col items-center justify-center p-12 text-center text-slate-300">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="far fa-comments text-3xl opacity-20"></i>
                                    </div>
                                    <p class="text-xs font-bold uppercase tracking-widest">Aucun message</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #e2e8f0; }
    </style>
</x-app-layout>
