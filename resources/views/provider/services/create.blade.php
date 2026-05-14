<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('provider.dashboard') }}" class="text-blue-600 font-bold hover:underline flex items-center gap-2 mb-4">
                    <i class="fas fa-arrow-left"></i> Retour au dashboard
                </a>
                <h1 class="text-4xl font-black text-gray-900">Ajouter un Service</h1>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10">
                <form action="{{ route('provider.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Titre du service</label>
                        <input type="text" name="title" required class="w-full rounded-xl border-gray-200 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Réparation plomberie urgente">
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Catégorie</label>
                        <select name="category_id" required class="w-full rounded-xl border-gray-200 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="5" required class="w-full rounded-xl border-gray-200 focus:ring-blue-500 focus:border-blue-500" placeholder="Décrivez votre service en détail..."></textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Prix (DH)</label>
                            <input type="number" name="price" step="0.01" class="w-full rounded-xl border-gray-200 focus:ring-blue-500 focus:border-blue-500" placeholder="0.00">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">WhatsApp (Format: 212600...)</label>
                            <input type="text" name="whatsapp" class="w-full rounded-xl border-gray-200 focus:ring-blue-500 focus:border-blue-500" placeholder="212600000000">
                        </div>
                    </div>

                    <div class="mb-10">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Image du service</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl hover:border-blue-400 transition-colors cursor-pointer relative">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <div class="flex text-sm text-gray-600">
                                    <span class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">Télécharger un fichier</span>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                            </div>
                            <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-2xl hover:bg-blue-700 transition-all shadow-xl text-lg">
                        Créer le service
                    </button>
                </form>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>
