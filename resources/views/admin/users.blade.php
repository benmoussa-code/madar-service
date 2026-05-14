<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 font-bold hover:underline flex items-center gap-2 mb-4">
                    <i class="fas fa-arrow-left"></i> Retour au dashboard
                </a>
                <h1 class="text-4xl font-black text-gray-900">Gestion des Utilisateurs</h1>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-black tracking-widest">
                            <tr>
                                <th class="px-8 py-5">Utilisateur</th>
                                <th class="px-8 py-5">Rôle</th>
                                <th class="px-8 py-5">Statut</th>
                                <th class="px-8 py-5">Inscrit le</th>
                                <th class="px-8 py-5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-400">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-sm font-bold uppercase tracking-wider text-gray-500">
                                        {{ $user->role }}
                                    </td>
                                    <td class="px-8 py-6">
                                        @if($user->status === 'active')
                                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                                Actif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                                Bloqué
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-sm text-gray-400">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.status', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $user->status === 'active' ? 'blocked' : 'active' }}">
                                                <button type="submit" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-200 transition-all">
                                                    {{ $user->status === 'active' ? 'Bloquer' : 'Débloquer' }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-8">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>
