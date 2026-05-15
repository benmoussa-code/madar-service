<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-12">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-11 h-11 bg-gradient-to-tr from-blue-600 to-blue-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30 group-hover:rotate-12 transition-all duration-300">
                            <i class="fas fa-compass text-xl"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-black text-slate-900 tracking-tight leading-none">Madar<span class="text-blue-600">Service</span></span>
                            <span class="text-[8px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">Expertise Locale</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:flex h-full">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-blue-600 text-slate-900' : 'border-transparent text-slate-400 hover:text-slate-600' }} text-xs font-bold uppercase tracking-widest transition-all">
                        {{ __('Accueil') }}
                    </a>
                    <a href="{{ route('services.index') }}" class="inline-flex items-center px-4 pt-1 border-b-2 {{ request()->routeIs('services.*') && !request()->routeIs('provider.*') ? 'border-blue-600 text-slate-900' : 'border-transparent text-slate-400 hover:text-slate-600' }} text-xs font-bold uppercase tracking-widest transition-all">
                        {{ __('Services') }}
                    </a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 pt-1 border-b-2 {{ request()->routeIs('admin.*') ? 'border-blue-600 text-slate-900' : 'border-transparent text-slate-400 hover:text-slate-600' }} text-xs font-bold uppercase tracking-widest transition-all">
                                {{ __('Administration') }}
                            </a>
                        @elseif(auth()->user()->isProvider())
                            <a href="{{ route('provider.dashboard') }}" class="inline-flex items-center px-4 pt-1 border-b-2 {{ request()->routeIs('provider.*') ? 'border-blue-600 text-slate-900' : 'border-transparent text-slate-400 hover:text-slate-600' }} text-xs font-bold uppercase tracking-widest transition-all">
                                {{ __('Dashboard') }}
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-4 py-2 border border-slate-100 text-xs font-bold uppercase tracking-widest rounded-xl text-slate-500 bg-slate-50/50 hover:bg-slate-100 hover:text-slate-900 focus:outline-none transition-all">
                                    <div class="w-6 h-6 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-2 text-[10px]">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div>{{ Auth::user()->name }}</div>
                                    <i class="fas fa-chevron-down ms-2 text-[10px] opacity-30"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="p-2 space-y-1">
                                    <x-dropdown-link :href="route('profile.edit')" class="rounded-lg text-xs font-bold uppercase tracking-widest">
                                        {{ __('Mon Profil') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                                class="rounded-lg text-xs font-bold uppercase tracking-widest text-red-600 hover:bg-red-50">
                                            {{ __('Déconnexion') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors px-4 py-2">
                            {{ __('Connexion') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-xl hover:bg-slate-900 transition-all shadow-lg shadow-blue-500/10 active:scale-95">
                            {{ __('Inscription') }}
                        </a>
                    </div>
                @endauth

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-900 hover:bg-slate-100 focus:outline-none transition-all">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-50 bg-white">
        <div class="pt-4 pb-6 space-y-2 px-4">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }}">
                {{ __('Accueil') }}
            </a>
            <a href="{{ route('services.index') }}" class="block px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest {{ request()->routeIs('services.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }}">
                {{ __('Services') }}
            </a>
            
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest {{ request()->routeIs('admin.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }}">
                        {{ __('Admin Dashboard') }}
                    </a>
                @elseif(auth()->user()->isProvider())
                    <a href="{{ route('provider.dashboard') }}" class="block px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest {{ request()->routeIs('provider.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50' }}">
                        {{ __('Provider Dashboard') }}
                    </a>
                @endif
                
                <div class="pt-4 mt-4 border-t border-slate-50">
                    <div class="px-4 mb-4">
                        <div class="text-sm font-black text-slate-900">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ Auth::user()->email }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest text-slate-500 hover:bg-slate-50">
                        {{ __('Mon Profil') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest text-red-600 hover:bg-red-50">
                            {{ __('Déconnexion') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-4 mt-4 border-t border-slate-50 space-y-2">
                    <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest text-slate-500 hover:bg-slate-50 text-center border border-slate-100">
                        {{ __('Connexion') }}
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest bg-blue-600 text-white text-center shadow-lg shadow-blue-500/10">
                        {{ __('Inscription') }}
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
