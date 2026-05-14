<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-4xl font-black text-gray-900 mb-2">Tableau de bord</h1>
                    <p class="text-gray-500 font-medium">Gérez vos services et suivez vos performances.</p>
                </div>
                <a href="{{ route('provider.services.create') }}" class="bg-blue-600 text-white font-bold px-8 py-4 rounded-2xl hover:bg-blue-700 transition-all shadow-xl flex items-center gap-3 transform hover:scale-105">
                    <i class="fas fa-plus"></i>
                    Ajouter un service
                </a>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-briefcase text-xl"></i>
                        </div>
                        <span class="text-gray-500 font-bold uppercase tracking-widest text-xs">Services actifs</span>
                    </div>
                    <div class="text-4xl font-black text-gray-900">{{ $stats['total_services'] }}</div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-eye text-xl"></i>
                        </div>
                        <span class="text-gray-500 font-bold uppercase tracking-widest text-xs">Vues totales</span>
                    </div>
                    <div class="text-4xl font-black text-gray-900">{{ $stats['total_views'] }}</div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-star text-xl"></i>
                        </div>
                        <span class="text-gray-500 font-bold uppercase tracking-widest text-xs">Avis clients</span>
                    </div>
                    <div class="text-4xl font-black text-gray-900">{{ $stats['total_reviews'] }}</div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Services Table -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-8 border-b border-gray-50">
                            <h2 class="text-xl font-bold text-gray-800">Mes Services</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-black tracking-widest">
                                    <tr>
                                        <th class="px-8 py-5">Service</th>
                                        <th class="px-8 py-5">Catégorie</th>
                                        <th class="px-8 py-5">Statut</th>
                                        <th class="px-8 py-5 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach($services as $service)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-8 py-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                                                        @if($service->image)
                                                            <img src="{{ str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-full h-full object-cover">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-gray-800 line-clamp-1">{{ $service->title }}</div>
                                                        <div class="text-sm text-gray-400 font-medium">{{ $service->views }} vues</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $service->category->name }}</span>
                                            </td>
                                            <td class="px-8 py-6">
                                                <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold {{ $service->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                    {{ $service->status }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-6 text-right">
                                                <div class="flex justify-end gap-3">
                                                    <a href="{{ route('provider.services.edit', $service) }}" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                        <i class="fas fa-edit"></i>
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
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                            <h2 class="text-xl font-bold text-gray-800">Messages</h2>
                            <span class="bg-blue-600 text-white text-[10px] font-black px-2 py-1 rounded-lg">{{ $messages->count() }}</span>
                        </div>
                        <div class="divide-y divide-gray-50 max-h-[600px] overflow-y-auto">
                            @foreach($messages as $message)
                                <div class="p-6 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-black uppercase">
                                            {{ substr($message->sender->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-black text-gray-800">{{ $message->sender->name }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase">{{ $message->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">{{ $message->content }}</p>
                                </div>
                            @endforeach
                            @if($messages->isEmpty())
                                <div class="p-12 text-center text-gray-400">
                                    <i class="far fa-comments text-4xl mb-4 opacity-20"></i>
                                    <p class="text-sm font-medium">Aucun message reçu.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>
