<x-app-layout>
    <div class="py-16 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
                <div class="space-y-1">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                        @if(auth()->user()->role === 'provider')
                            Bonjour, {{ auth()->user()->name }} 👋
                        @else
                            Annonces Clients
                        @endif
                    </h1>
                    <p class="text-slate-400 text-sm font-medium">
                        @if(auth()->user()->role === 'provider')
                            Voici les annonces qui correspondent à votre expertise.
                        @else
                            Découvrez les besoins des clients et proposez vos services.
                        @endif
                    </p>
                </div>
                @if(auth()->user()->role === 'client')
                    <a href="{{ route('announcements.create') }}" class="bg-blue-600 text-white font-bold px-8 py-4 rounded-2xl hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/20 flex items-center gap-3 active:scale-95">
                        <i class="fas fa-plus text-xs"></i>
                        Publier une annonce
                    </a>
                @endif
            </div>

            <div class="grid gap-8">
                @forelse($announcements as $announcement)
                    <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 p-8 md:p-10 group hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-500">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 text-2xl shrink-0 group-hover:bg-blue-50 group-hover:text-blue-600 transition-all shadow-inner">
                                <i class="fas fa-{{ $announcement->category->icon }}"></i>
                            </div>
                            
                            <div class="flex-1 space-y-4">
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-blue-100">
                                        {{ $announcement->category->name }}
                                    </span>
                                    <span class="bg-slate-50 text-slate-500 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-slate-100 flex items-center gap-2">
                                        <i class="far fa-calendar-alt text-[8px]"></i>
                                        Pour le : {{ \Carbon\Carbon::parse($announcement->service_date)->format('d/m/Y') }}
                                    </span>
                                </div>
                                
                                <h2 class="text-2xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $announcement->title }}</h2>
                                
                                <div class="flex flex-col lg:flex-row gap-6">
                                    <div class="flex-1">
                                        <p class="text-slate-500 leading-relaxed font-medium">{{ $announcement->description }}</p>
                                    </div>
                                    @if($announcement->image)
                                        <div class="lg:w-48 h-32 rounded-2xl overflow-hidden shrink-0 border border-slate-100">
                                            <img src="{{ asset('storage/' . $announcement->image) }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500" alt="Illustration">
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500 uppercase">
                                            {{ substr($announcement->user->name, 0, 1) }}
                                        </div>
                                        <div class="text-[11px] font-bold text-slate-700">{{ $announcement->user->name }}</div>
                                    </div>
                                    
                                    @if(auth()->user()->role === 'provider')
                                        <div class="flex items-center gap-4">
                                            <a href="tel:{{ $announcement->user->phone }}" class="text-blue-600 font-bold text-sm hover:underline">
                                                <i class="fas fa-phone-alt mr-2"></i>Contacter
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 p-20 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="far fa-clipboard text-4xl text-slate-200"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Aucune annonce pour le moment</h3>
                        <p class="text-slate-400 text-sm font-medium">Revenez plus tard pour voir de nouvelles opportunités.</p>
                    </div>
                @endforelse
                
                <div class="mt-10">
                    {{ $announcements->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
