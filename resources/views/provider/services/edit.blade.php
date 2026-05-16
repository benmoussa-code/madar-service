<x-app-layout>
    <div class="py-16 bg-[#f8fafc] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex items-center justify-between">
                <div class="space-y-1">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Modifier le Service</h1>
                    <p class="text-slate-400 text-sm font-medium">Mettez à jour les détails de votre prestation.</p>
                </div>
                <a href="{{ route('provider.dashboard') }}" class="inline-flex items-center text-sm font-bold text-slate-400 hover:text-slate-900 transition-colors group">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Retour
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 p-10 md:p-14">
                <form action="{{ route('provider.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PATCH')
                    
                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Titre du service</label>
                        <input type="text" name="title" value="{{ old('title', $service->title) }}" required 
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-6 text-sm transition-all placeholder:text-slate-300" 
                            placeholder="Ex: Réparation plomberie urgente">
                        @error('title') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Catégorie</label>
                        <select name="category_id" required 
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-6 text-sm transition-all appearance-none cursor-pointer">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Description détaillée</label>
                        <textarea name="description" rows="6" required 
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-6 text-sm transition-all placeholder:text-slate-300" 
                            placeholder="Décrivez votre service...">{{ old('description', $service->description) }}</textarea>
                        @error('description') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Prix indicatif (DH)</label>
                            <div class="relative">
                                <input type="number" name="price" step="0.01" value="{{ old('price', $service->price) }}"
                                    class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-6 text-sm transition-all placeholder:text-slate-300" 
                                    placeholder="0.00">
                                <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-300 uppercase">DH</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">WhatsApp (Optionnel)</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $service->whatsapp) }}"
                                class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-6 text-sm transition-all placeholder:text-slate-300" 
                                placeholder="212600000000">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Image du service</label>
                        
                        @if($service->image)
                            <div class="relative w-40 h-40 rounded-2xl overflow-hidden border border-slate-100 group">
                                <img src="{{ str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[8px] font-bold text-white uppercase tracking-widest">Image actuelle</span>
                                </div>
                            </div>
                        @endif

                        <div class="group relative mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-slate-100 border-dashed rounded-3xl hover:border-blue-400 hover:bg-blue-50/30 transition-all cursor-pointer overflow-hidden">
                            <div class="space-y-2 text-center relative z-10">
                                <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:text-blue-500 transition-all">
                                    <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                </div>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <span class="font-bold text-blue-600">Modifier l'image</span>
                                </div>
                                <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Laissez vide pour conserver l'actuelle</p>
                            </div>
                            <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-20">
                        </div>
                        @error('image') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Portfolio (Images de votre travail)</label>
                        
                        @if($service->images->count() > 0)
                            <div class="grid grid-cols-4 gap-4 mb-4">
                                @foreach($service->images as $img)
                                    <div class="relative aspect-square rounded-xl overflow-hidden border border-slate-100">
                                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="group relative mt-1 flex justify-center px-6 pt-6 pb-6 border-2 border-slate-100 border-dashed rounded-3xl hover:border-blue-400 hover:bg-blue-50/30 transition-all cursor-pointer overflow-hidden">
                            <div class="space-y-2 text-center relative z-10">
                                <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-hover:text-blue-500 transition-all">
                                    <i class="fas fa-images text-xl"></i>
                                </div>
                                <div class="flex text-xs text-slate-600 justify-center">
                                    <span class="font-bold text-blue-600">Ajouter des images au portfolio</span>
                                </div>
                            </div>
                            <input type="file" name="portfolio[]" multiple class="absolute inset-0 opacity-0 cursor-pointer z-20">
                        </div>
                        @error('portfolio.*') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-slate-900 text-white font-bold py-5 rounded-2xl hover:bg-blue-600 transition-all shadow-xl hover:shadow-blue-500/20 active:scale-[0.98] text-sm uppercase tracking-widest">
                            Mettre à jour le service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
