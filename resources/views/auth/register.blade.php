<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Rejoignez Madar Service</h2>
        <p class="text-slate-400 text-sm font-medium mt-1">Choisissez votre type de compte pour commencer.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6" x-data="{ role: '{{ old('role', 'client') }}' }">
        @csrf

        <!-- Role Selection -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <label class="relative cursor-pointer group">
                <input type="radio" name="role" value="client" class="peer hidden" required x-model="role">
                <div class="rounded-2xl border-2 border-slate-100 bg-white hover:border-blue-400 peer-checked:border-blue-600 peer-checked:bg-blue-50 transition-all overflow-hidden">
                    <div class="h-24 relative overflow-hidden">
                        <img src="https://images.pexels.com/photos/3585088/pexels-photo-3585088.jpeg?auto=compress&cs=tinysrgb&w=400" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-t from-white peer-checked:from-blue-50 to-transparent"></div>
                    </div>
                    <div class="p-4 text-center">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 mx-auto mb-2 peer-checked:bg-blue-600 peer-checked:text-white transition-all">
                            <i class="fas fa-user text-xs"></i>
                        </div>
                        <span class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 peer-checked:text-blue-600">Client</span>
                    </div>
                </div>
            </label>

            <label class="relative cursor-pointer group">
                <input type="radio" name="role" value="provider" class="peer hidden" x-model="role">
                <div class="rounded-2xl border-2 border-slate-100 bg-white hover:border-blue-400 peer-checked:border-blue-600 peer-checked:bg-blue-50 transition-all overflow-hidden">
                    <div class="h-24 relative overflow-hidden">
                        <img src="https://images.pexels.com/photos/2244746/pexels-photo-2244746.jpeg?auto=compress&cs=tinysrgb&w=400" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-t from-white peer-checked:from-blue-50 to-transparent"></div>
                    </div>
                    <div class="p-4 text-center">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 mx-auto mb-2 peer-checked:bg-blue-600 peer-checked:text-white transition-all">
                            <i class="fas fa-tools text-xs"></i>
                        </div>
                        <span class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 peer-checked:text-blue-600">Prestataire</span>
                    </div>
                </div>
            </label>
        </div>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />

        <!-- Provider Specific Field -->
        <div x-show="role === 'provider'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4 pb-4" x-data="{ main_service: '' }">
            <div class="space-y-2">
                <x-input-label for="main_service" :value="__('Votre spécialité principale')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                <select name="main_service" x-model="main_service" class="w-full rounded-2xl border-slate-100 bg-blue-50/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 transition-all text-sm font-bold text-blue-900 py-4 px-6 appearance-none cursor-pointer" :required="role === 'provider'">
                    <option value="">Sélectionnez un service</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    <option value="other">Autre (Précisez...)</option>
                </select>
            </div>

            <div x-show="main_service === 'other'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="space-y-2">
                <x-input-label for="custom_service" :value="__('Nom de votre service')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
                <x-text-input id="custom_service" name="custom_service" class="block w-full rounded-2xl border-blue-200 bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 transition-all placeholder:text-slate-300" placeholder="Ex: Coaching Sportif, Réparation Bijoux..." :required="main_service === 'other'" />
            </div>
            
            <p class="text-[9px] text-blue-400 font-medium ml-1 italic">Une annonce sera créée automatiquement pour ce service.</p>
        </div>

        <!-- Name -->
        <div class="space-y-1">
            <x-input-label for="name" :value="__('Nom complet')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
            <x-text-input id="name" class="block mt-1 w-full rounded-2xl border-slate-100 bg-slate-50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 space-y-1">
            <x-input-label for="email" :value="__('Email')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
            <x-text-input id="email" class="block mt-1 w-full rounded-2xl border-slate-100 bg-slate-50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 space-y-1">
            <x-input-label for="password" :value="__('Mot de passe')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
            <x-text-input id="password" class="block mt-1 w-full rounded-2xl border-slate-100 bg-slate-50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 space-y-1">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-2xl border-slate-100 bg-slate-50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col space-y-4 mt-8">
            <x-primary-button class="w-full justify-center bg-slate-900 py-4 rounded-2xl hover:bg-blue-600 transition-all shadow-xl hover:shadow-blue-500/20 text-sm uppercase tracking-widest font-bold">
                {{ __("Créer mon compte") }}
            </x-primary-button>
            
            <p class="text-center text-sm text-slate-400 font-medium">
                Déjà inscrit ? 
                <a class="text-blue-600 font-bold hover:underline" href="{{ route('login') }}">
                    {{ __('Se connecter') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
