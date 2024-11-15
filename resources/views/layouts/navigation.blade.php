<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center"> <!-- Assurez-vous que tous les éléments enfants partagent ces classes -->
            <div class="flex items-center space-x-8"> <!-- Flex container pour maintenir l'alignement des items -->

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('accueil') }}">
                        <img src="/pictures/logo.png" class="w-20 h-20" alt="Logo">
                    </a>
                </div>

                <!-- Navigation Links -->

                @if(auth()->check())
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">
                        {{ __('Accueil') }}
                    </x-nav-link>

                    <x-slot name="content">

                    <!-- Dropdown Menu for Boutique -->
                    <div @mouseover="open = true" @mouseleave="open = false" class="relative">
                        <x-nav-link :href="route('boutique')" :active="request()->routeIs('boutique')">
                            {{ __('Boutique') }}
                        </x-nav-link>

                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition class="absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="{{ route('packs.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900">
                                    {{ __('Ouvrir des packs') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    
                    <x-nav-link :href="route('cartes')">
                        {{ __('Cartes') }}
                    </x-nav-link>                       


                    <x-nav-link :href="route('classement')" :active="request()->routeIs('classement')">
                        {{ __('Classement') }}
                    </x-nav-link>

                    <x-nav-link :href="route('boutique')" :active="request()->routeIs('boutique')">
                    Points: {{ auth()->user()->points }}
                    </x-nav-link>

                    @else

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">
                        {{ __('Accueil') }}
                    </x-nav-link>

                    <x-nav-link :href="route('boutique')" :active="request()->routeIs('boutique')">
                        {{ __('Boutique') }}
                    </x-nav-link>

                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Inscription') }}
                    </x-nav-link>

                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Connexion') }}
                    </x-nav-link>

                    @endif


                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
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
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Se deconnecter') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">


            @auth
        
            <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('boutique')" :active="request()->routeIs('boutique')">
                    Points: {{ auth()->user()->points }}
            </x-responsive-nav-link>                

            <x-responsive-nav-link :href="route('cartes')" :active="request()->routeIs('cartes')">
            {{ __('Cartes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('classement')" :active="request()->routeIs('classement')">
                {{ __('Classement') }}
            </x-responsive-nav-link>

        </div>
        
        @endauth

        @guest

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('boutique')" :active="request()->routeIs('boutique')">
            {{ __('Boutique') }}
            </x-responsive-nav-link>
        </div>

        @endguest



        <!-- Responsive Settings Options -->

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
            <div class="px-4">
            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Deconnexion') }}
                    </x-responsive-nav-link>
                </form>
                @endauth

                @guest

                <div class="pt-2 pb-3 space-y-1">

                    <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Connexion') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Inscription') }}
                    </x-responsive-nav-link>

                </div>

                @endguest
            </div>
        </div>
    </div>
</nav>

@vite(['public/css/app.css', 'public/js/app.js'])
