<x-app-layout>
    <div class="py-16 bg-[#f8fafc] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex items-center justify-between">
                <div class="space-y-1">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Publier une annonce</h1>
                    <p class="text-slate-400 text-sm font-medium">Décrivez votre besoin et trouvez le bon prestataire.</p>
                </div>
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-bold text-slate-400 hover:text-slate-900 transition-colors group">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Retour
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100 p-10 md:p-14">
                <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Titre de votre besoin</label>
                        <input type="text" name="title" value="{{ old('title') }}" required 
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-6 text-sm transition-all placeholder:text-slate-300" 
                            placeholder="Ex: Besoin d'un électricien pour demain matin">
                        @error('title') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Catégorie de service</label>
                        <select name="category_id" required 
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-6 text-sm transition-all appearance-none cursor-pointer">
                            <option value="" disabled selected>Quelle expertise recherchez-vous ?</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Date souhaitée</label>
                        <input type="date" name="service_date" value="{{ old('service_date') }}" required 
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-6 text-sm transition-all">
                        @error('service_date') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Image illustrative (Optionnel)</label>
                        <div class="relative group">
                            <input type="file" name="image" 
                                class="w-full rounded-2xl border-2 border-dashed border-slate-100 bg-slate-50/50 hover:bg-slate-50 hover:border-blue-200 focus:ring-4 focus:ring-blue-500/10 py-8 px-6 text-sm transition-all cursor-pointer file:hidden text-transparent select-none">
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none text-slate-300 group-hover:text-blue-400 transition-colors">
                                <i class="fas fa-cloud-upload-alt mr-4 text-lg"></i>
                                <span class="text-[10px] font-bold uppercase tracking-widest">Cliquez ici pour ajouter une photo illustrative</span>
                            </div>
                        </div>
                        @error('image') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Description détaillée</label>
                        <textarea name="description" rows="5" required 
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-6 text-sm transition-all placeholder:text-slate-300" 
                            placeholder="Détaillez votre besoin (lieu exact, urgence, détails techniques...)">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-slate-900 text-white font-bold py-5 rounded-2xl hover:bg-blue-600 transition-all shadow-xl hover:shadow-blue-500/20 active:scale-[0.98] text-sm uppercase tracking-widest">
                            Publier mon annonce
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
