<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- =====================
         Primary Navigation Menu
    ===================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- =====================
                     Logo (redirige selon rôle)
                ===================== -->
                <div class="shrink-0 flex items-center">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}">
                        @elseif(auth()->user()->role === 'store' && auth()->user()->store_id)
                            <a href="{{ route('store.dashboard', auth()->user()->store_id) }}">
                        @else
                            <a href="{{ route('dashboard') }}">
                        @endif
                            <img src="{{ asset('images/r4e-logo.png') }}" alt="R4E" class="h-12 w-auto">
                        </a>
                    @endauth
                </div>

                <!-- =====================
                     Navigation Links (Desktop)
                ===================== -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    {{-- =====================
                         ADMIN
                    ===================== --}}
                    @auth
                    @if(auth()->user()->role === 'admin')

                        @php
                            $savPendingCount = \App\Models\ConsoleReturn::whereIn('status', ['pending', 'accepted', 'sent_to_repairer'])
                                ->where('acknowledged', false)
                                ->count();
                        
                        // Détecter si admin est dans une vue magasin
                        $currentStore = null;
                        if (request()->route('store')) {
                            $currentStore = request()->route('store');
                        }
                    @endphp

                    @if($currentStore)
                        <x-nav-link :href="route('store.dashboard', $currentStore)" :active="request()->routeIs('store.dashboard')">
                            🏪 Dashboard magasin
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            Dashboard admin
                        </x-nav-link>
                    @endif
                        </x-nav-link> --}}

                    @endif
                    @endauth

                    {{-- =====================
                         MAGASIN
                    ===================== --}}
                    @auth
                    @if(auth()->user()->role === 'store' && auth()->user()->store_id)
                        <x-nav-link
                            :href="route('store.dashboard', auth()->user()->store_id)"
                            :active="request()->routeIs('store.dashboard')">
                            🏪 Mon stock
                        </x-nav-link>

                        <x-nav-link
                            :href="route('store.offers.index')"
                            :active="request()->routeIs('store.offers.*')">
                            📦 Offres disponibles
                        </x-nav-link>

                        <x-nav-link
                            :href="route('store.sales', auth()->user()->store_id)"
                            :active="request()->routeIs('store.sales')">
                            💰 Mes ventes
                        </x-nav-link>

                        <x-nav-link
                            :href="route('store.external-repair.create', auth()->user()->store_id)"
                            :active="request()->routeIs('store.external-repair.*')">
                            🔧 Réparation externe
                        </x-nav-link>
                    @endif
                    @endauth

                    {{-- =====================
                         RÉPARATEUR
                    ===================== --}}
                    @auth
                    @if(auth()->user()->repairer_id)
                        <x-nav-link
                            :href="route('repairer.consoles.index')"
                            :active="request()->routeIs('repairer.consoles.*')">
                            🔧 Mes consoles
                        </x-nav-link>
                    @endif
                    @endauth

                </div>
            </div>

            <!-- =====================
                 Settings Dropdown
            ===================== -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Déconnexion
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <!-- =====================
                 Hamburger (Mobile)
            ===================== -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- =====================
         Responsive Menu (Mobile)
    ===================== -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            @auth
            {{-- ADMIN --}}
            @if(auth()->user()->role === 'admin')
                @php
                    $savPendingCount = \App\Models\ConsoleReturn::whereIn('status', ['pending', 'accepted', 'sent_to_repairer'])
                        ->where('acknowledged', false)
                        ->count();
                    
                    // Détecter si admin est dans une vue magasin
                    $currentStore = null;
                    if (request()->route('store')) {
                        $currentStore = request()->route('store');
                    }
                @endphp

                @if($currentStore)
                    <x-responsive-nav-link :href="route('store.dashboard', $currentStore)">
                        🏪 Dashboard magasin
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('admin.dashboard')">
                        Dashboard admin
                    </x-responsive-nav-link>
                @endif

                {{-- DÉSACTIVÉ - Vue prix console retirée --}}
                {{-- <x-responsive-nav-link :href="route('admin.prices.index')">
                    💰 Prix consoles
                </x-responsive-nav-link> --}}

                {{-- ✅ AJOUT : SAV --}}
                <x-responsive-nav-link :href="route('admin.returns.index')" class="flex items-center gap-2 @if($savPendingCount>0) text-red-600 animate-pulse @endif">
                    🛠️ SAV
                    @if($savPendingCount>0)
                        <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">{{ $savPendingCount }}</span>
                    @endif
                </x-responsive-nav-link>
            @endif

            {{-- MAGASIN --}}
            @if(auth()->user()->role === 'store' && auth()->user()->store_id)
                <x-responsive-nav-link
                    :href="route('store.dashboard', auth()->user()->store_id)">
                    🏪 Mon stock
                </x-responsive-nav-link>
            @endif
            @endauth

        </div>

        <!-- Responsive Settings -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Déconnexion
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
