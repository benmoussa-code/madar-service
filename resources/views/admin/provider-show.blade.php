<x-app-layout>
    <div class="py-16 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-12 flex justify-between items-end">
                <div class="space-y-1">
                    <div class="flex items-center gap-3 mb-2">
                        <a href="{{ route('admin.dashboard') }}" class="w-8 h-8 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-100 transition-all shadow-sm">
                            <i class="fas fa-chevron-left text-[10px]"></i>
                        </a>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Inspection Prestataire</span>
                    </div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h1>
                    <p class="text-slate-400 text-sm font-medium">{{ $user->email }} • Membre depuis {{ $user->created_at->format('M Y') }}</p>
                </div>
                
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer tout le compte de ce prestataire ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-50 text-red-600 font-bold px-6 py-3 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm text-xs uppercase tracking-widest active:scale-95 border border-red-100">
                        Supprimer le compte
                    </button>
                </form>
            </div>

            <!-- Content Grid -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Info Card -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6">Informations</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mb-1">Ville</div>
                                <div class="text-sm font-bold text-slate-700">{{ $user->city ?? 'Non spécifié' }}</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mb-1">Téléphone</div>
                                <div class="text-sm font-bold text-slate-700">{{ $user->phone ?? 'Non spécifié' }}</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nombre de Services</div>
                                <div class="text-sm font-bold text-slate-700">{{ $services->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services List -->
                <div class="lg:col-span-2 space-y-6">
                    <h2 class="text-xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                        Services Publiés
                        <span class="bg-slate-100 text-slate-500 text-[10px] px-2 py-0.5 rounded-full">{{ $services->count() }}</span>
                    </h2>

                    @forelse($services as $service)
                        <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 overflow-hidden group">
                            <div class="p-8">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="flex gap-6">
                                        <div class="w-24 h-24 rounded-2xl bg-slate-50 overflow-hidden border border-slate-100 shrink-0">
                                            @if($service->image)
                                                <img src="{{ str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <i class="fas fa-image text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="text-[8px] font-bold uppercase py-0.5 px-2 rounded-md {{ $service->status === 'approved' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-yellow-50 text-yellow-600 border border-yellow-100' }}">
                                                    {{ $service->status === 'approved' ? 'Approuvé' : 'Attente' }}
                                                </span>
                                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">{{ $service->category->name }}</span>
                                            </div>
                                            <h4 class="text-lg font-bold text-slate-900 mb-2 truncate">{{ $service->title }}</h4>
                                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 mb-4">{{ $service->description }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Voulez-vous supprimer ce service ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all active:scale-90 border border-red-100">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Portfolio Images -->
                                @if($service->portfolioImages->count() > 0)
                                    <div class="border-t border-slate-50 pt-6">
                                        <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-4">Portfolio / Images de travail</div>
                                        <div class="grid grid-cols-4 gap-4">
                                            @foreach($service->portfolioImages as $img)
                                                <div class="relative aspect-square rounded-xl overflow-hidden border border-slate-100 group/img">
                                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-12 rounded-[2rem] border-2 border-dashed border-slate-100 text-center">
                            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">Aucun service publié</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
