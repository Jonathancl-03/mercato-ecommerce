<nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.scrollY > 20)"
    :class="scrolled ? 'bg-white/90 dark:bg-ink-900/90 backdrop-blur-lg shadow-sm border-b-2 border-forest-600/40' : 'bg-stone-50 dark:bg-ink-900 border-b-2 border-forest-600 dark:border-forest-600/50'"
    class="sticky top-0 z-40 transition-all duration-300">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center shrink-0">
                <x-brand-logo />
            </div>

            <!-- Píldora Tienda/Pedidos, centrada -->
            <div class="hidden sm:flex flex-1 justify-center">
                <x-floating-nav />
            </div>

            <!-- Toggle + Carrito + Cuenta -->
            <div class="hidden sm:flex sm:items-center gap-3 shrink-0">

                <!-- Toggle modo oscuro -->
                <div x-data="{
                        isDark: document.documentElement.classList.contains('dark'),
                        toggle() {
                            this.isDark = !this.isDark;
                            document.documentElement.classList.toggle('dark', this.isDark);
                            localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                        }
                     }" @click="toggle()"
                    class="flex w-16 h-8 p-1 rounded-full cursor-pointer transition-all duration-300"
                    :class="isDark ? 'bg-ink-900 border border-stone-700' : 'bg-white border border-stone-100'">
                    <div class="flex justify-between items-center w-full">
                        <div class="flex justify-center items-center w-6 h-6 rounded-full transition-transform duration-300"
                            :class="isDark ? 'translate-x-0 bg-forest-600' : 'translate-x-8 bg-stone-100'">
                            <svg x-show="isDark" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg x-show="!isDark" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mustard-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                                style="display:none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="flex justify-center items-center w-6 h-6 rounded-full transition-transform duration-300"
                            :class="isDark ? '-translate-x-8' : ''">
                            <svg x-show="!isDark" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-ink-900/40"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                                style="display:none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg x-show="isDark" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-mustard-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Carrito -->
                <x-cart-icon />

                @auth
                    <!-- Dropdown de usuario -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-white/70 bg-white dark:bg-ink-900 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-forest-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-forest-700 transition-colors">
                        Iniciar sesión
                    </a>
                @endauth
            </div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Tienda') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                    {{ __('Carrito') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                    {{ __('Mis pedidos') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-stone-700">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-white/50">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Iniciar sesión') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>