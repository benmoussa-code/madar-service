<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-black text-gray-900 mb-10">Admin Dashboard</h1>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Utilisateurs</div>
                    <div class="text-4xl font-black text-gray-900">{{ $stats['users'] }}</div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Services</div>
                    <div class="text-4xl font-black text-gray-900">{{ $stats['services'] }}</div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 border-l-4 border-l-yellow-400">
                    <div class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">En Attente</div>
                    <div class="text-4xl font-black text-yellow-600">{{ $stats['pending_services'] }}</div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Avis</div>
                    <div class="text-4xl font-black text-gray-900">{{ $stats['reviews'] }}</div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Recent Services -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-800">Services Récents</h2>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @foreach($recentServices as $service)
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50/50 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden shrink-0">
                                        @if($service->image)
                                            <img src="{{ str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800 line-clamp-1">{{ $service->title }}</div>
                                        <div class="text-xs text-gray-400 font-medium">Par {{ $service->user->name }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-xs font-bold uppercase py-1 px-3 rounded-full {{ $service->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $service->status }}
                                    </span>
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.services.status', $service) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="w-8 h-8 bg-green-50 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-all flex items-center justify-center">
                                                <i class="fas fa-check text-xs"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.services.status', $service) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-8 h-8 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all flex items-center justify-center">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Fast Links -->
                <div class="space-y-8">
                    <div class="bg-indigo-700 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                        <div class="relative z-10">
                            <h2 class="text-2xl font-bold mb-4">Gestion des Utilisateurs</h2>
                            <p class="opacity-80 mb-6">Bloquez ou supprimez des comptes pour maintenir la sécurité de la plateforme.</p>
                            <a href="{{ route('admin.users') }}" class="inline-block bg-white text-indigo-700 font-bold px-6 py-3 rounded-xl hover:bg-indigo-50 transition-all shadow-lg">
                                Gérer les utilisateurs
                            </a>
                        </div>
                        <i class="fas fa-users absolute bottom-0 right-0 -mr-8 -mb-8 text-9xl opacity-10"></i>
                    </div>

                    <div class="bg-emerald-600 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                        <div class="relative z-10">
                            <h2 class="text-2xl font-bold mb-4">Catégories</h2>
                            <p class="opacity-80 mb-6">Gérez les catégories de services disponibles sur le site.</p>
                            <a href="{{ route('admin.categories') }}" class="inline-block bg-white text-emerald-600 font-bold px-6 py-3 rounded-xl hover:bg-emerald-50 transition-all shadow-lg">
                                Gérer les catégories
                            </a>
                        </div>
                        <i class="fas fa-tags absolute bottom-0 right-0 -mr-8 -mb-8 text-9xl opacity-10"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>
