<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Mercato Admin') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-stone-50 dark:bg-ink-900" x-data="{ mobileSidebar: false }">

    <div class="flex min-h-screen">

        <!-- Sidebar (desktop) -->
        <aside class="hidden lg:flex lg:flex-col w-72 bg-ink-900 text-white flex-shrink-0">
            <div class="p-6 flex flex-col items-center text-center border-b border-white/10">
                <div class="w-16 h-16 rounded-full bg-forest-600 flex items-center justify-center text-2xl font-display font-semibold mb-3">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <p class="font-semibold">{{ Auth::user()->name }}</p>
                <p class="text-xs text-white/40 mt-0.5">{{ Auth::user()->email }}</p>
            </div>

            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-forest-600 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Dashboard
                </a>
                <a href="{{ route('productos.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('productos.*') ? 'bg-forest-600 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    Productos
                </a>
                <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('orders.index') ? 'bg-forest-600 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" /></svg>
                    Pedidos
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('profile.edit') ? 'bg-forest-600 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Mi perfil
                </a>

                @if(config('app.store_url'))
                    <a href="{{ config('app.store_url') }}" target="_blank" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-white/60 hover:bg-white/5 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        Ir a la tienda
                    </a>
                @endif
            </nav>

            <div class="p-4 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-white/60 hover:bg-white/5 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Sidebar móvil (drawer) -->
        <div x-show="mobileSidebar" x-cloak class="fixed inset-0 z-50 lg:hidden" style="display:none">
            <div class="absolute inset-0 bg-black/50" @click="mobileSidebar = false"></div>
            <aside class="absolute left-0 top-0 h-full w-72 bg-ink-900 text-white flex flex-col">
                <div class="p-6 flex flex-col items-center text-center border-b border-white/10">
                    <button @click="mobileSidebar = false" class="self-end text-white/50 mb-2">✕</button>
                    <div class="w-16 h-16 rounded-full bg-forest-600 flex items-center justify-center text-2xl font-display font-semibold mb-3">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-white/40 mt-0.5">{{ Auth::user()->email }}</p>
                </div>
                <nav class="flex-1 p-4 space-y-1">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-forest-600 text-white' : 'text-white/60' }}">Dashboard</a>
                    <a href="{{ route('productos.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('productos.*') ? 'bg-forest-600 text-white' : 'text-white/60' }}">Productos</a>
                    <a href="{{ route('orders.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('orders.index') ? 'bg-forest-600 text-white' : 'text-white/60' }}">Pedidos</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('profile.edit') ? 'bg-forest-600 text-white' : 'text-white/60' }}">Mi perfil</a>
                </nav>
                <div class="p-4 border-t border-white/10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2.5 rounded-xl text-sm font-medium text-white/60">Cerrar sesión</button>
                    </form>
                </div>
            </aside>
        </div>

        <!-- Contenido principal -->
        <div class="flex-1 flex flex-col min-w-0">
            <header class="flex items-center justify-between px-4 sm:px-6 py-4 border-b border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900">
                <button @click="mobileSidebar = true" class="lg:hidden text-ink-900 dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>

                <span class="font-display text-lg font-semibold text-forest-600 lg:hidden">Mercato Admin</span>

                <div class="flex items-center gap-4 ml-auto">
                    <div x-data="{
                            isDark: document.documentElement.classList.contains('dark'),
                            toggle() {
                                this.isDark = !this.isDark;
                                document.documentElement.classList.toggle('dark', this.isDark);
                                localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                            }
                         }"
                         @click="toggle()"
                         class="flex w-14 h-7 p-1 rounded-full cursor-pointer transition-all duration-300"
                         :class="isDark ? 'bg-ink-900 border border-stone-700' : 'bg-stone-100 border border-stone-200'">
                        <div class="w-5 h-5 rounded-full transition-transform duration-300 flex items-center justify-center text-xs"
                             :class="isDark ? 'translate-x-7 bg-forest-600' : 'translate-x-0 bg-white'">
                            <span x-text="isDark ? '🌙' : '☀️'"></span>
                        </div>
                    </div>
                </div>
            </header>

            @isset($header)
                <div class="bg-white dark:bg-ink-900 border-b border-stone-100 dark:border-white/10 px-4 sm:px-6 py-4">
                    {{ $header }}
                </div>
            @endisset

            <main class="flex-1 p-4 sm:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>