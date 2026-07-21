<div class="flex items-center gap-1 bg-white/80 dark:bg-ink-900/80 border border-stone-100 dark:border-stone-700 backdrop-blur-lg py-1.5 px-1.5 rounded-full shadow-sm" x-data="{ catOpen: false }">

    <a href="{{ route('welcome') }}"
       class="relative text-sm font-semibold px-4 py-2 rounded-full transition-colors
              {{ request()->routeIs('welcome') ? 'text-forest-700 dark:text-white' : 'text-ink-900/60 dark:text-white/50 hover:text-forest-600' }}">
        @if(request()->routeIs('welcome'))
            <div class="absolute inset-0 bg-forest-600/10 rounded-full -z-10"></div>
        @endif
        Inicio
    </a>

    <a href="{{ route('home') }}"
       class="relative text-sm font-semibold px-4 py-2 rounded-full transition-colors
              {{ request()->routeIs('home') ? 'text-forest-700 dark:text-white' : 'text-ink-900/60 dark:text-white/50 hover:text-forest-600' }}">
        @if(request()->routeIs('home'))
            <div class="absolute inset-0 bg-forest-600/10 rounded-full -z-10"></div>
        @endif
        Tienda
    </a>

    <!-- Categorías con dropdown -->
    <div class="relative" @mouseenter="catOpen = true" @mouseleave="catOpen = false">
        <button class="relative text-sm font-semibold px-4 py-2 rounded-full transition-colors text-ink-900/60 dark:text-white/50 hover:text-forest-600 flex items-center gap-1">
            Categorías
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="catOpen" x-cloak x-transition
             class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-44 z-50">
            <div class="bg-white dark:bg-ink-900 border border-stone-100 dark:border-white/10 rounded-xl shadow-lg py-2">
                <a href="{{ route('home') }}?category=muebles" class="block px-4 py-2 text-sm text-ink-900/70 dark:text-white/60 hover:bg-stone-50 dark:hover:bg-white/5">Muebles</a>
                <a href="{{ route('home') }}?category=electronica" class="block px-4 py-2 text-sm text-ink-900/70 dark:text-white/60 hover:bg-stone-50 dark:hover:bg-white/5">Electrónica</a>
                <a href="{{ route('home') }}?category=ropa" class="block px-4 py-2 text-sm text-ink-900/70 dark:text-white/60 hover:bg-stone-50 dark:hover:bg-white/5">Ropa</a>
                <a href="{{ route('home') }}?category=hogar" class="block px-4 py-2 text-sm text-ink-900/70 dark:text-white/60 hover:bg-stone-50 dark:hover:bg-white/5">Hogar</a>
            </div>
        </div>
    </div>

    <a href="{{ route('offers.index') }}"
       class="relative text-sm font-semibold px-4 py-2 rounded-full transition-colors
              {{ request()->routeIs('offers.index') ? 'text-mustard-500' : 'text-ink-900/60 dark:text-white/50 hover:text-mustard-500' }}">
        @if(request()->routeIs('offers.index'))
            <div class="absolute inset-0 bg-mustard-500/10 rounded-full -z-10"></div>
        @endif
        Ofertas
    </a>

    @auth
        <a href="{{ route('favorites.index') }}"
           class="relative text-sm font-semibold px-4 py-2 rounded-full transition-colors
                  {{ request()->routeIs('favorites.index') ? 'text-forest-700 dark:text-white' : 'text-ink-900/60 dark:text-white/50 hover:text-forest-600' }}">
            @if(request()->routeIs('favorites.index'))
                <div class="absolute inset-0 bg-forest-600/10 rounded-full -z-10"></div>
            @endif
            Favoritos
        </a>

        <a href="{{ route('orders.index') }}"
           class="relative text-sm font-semibold px-4 py-2 rounded-full transition-colors
                  {{ request()->routeIs('orders.index') ? 'text-forest-700 dark:text-white' : 'text-ink-900/60 dark:text-white/50 hover:text-forest-600' }}">
            @if(request()->routeIs('orders.index'))
                <div class="absolute inset-0 bg-forest-600/10 rounded-full -z-10"></div>
            @endif
            Pedidos
        </a>
    @endauth
</div>