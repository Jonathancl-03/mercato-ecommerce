@php
    $cartCount = auth()->check()
        ? \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity')
        : 0;
@endphp

<a href="{{ route('cart.index') }}"
   class="relative flex items-center justify-center w-10 h-10 rounded-full transition-colors
          {{ request()->routeIs('cart.index') ? 'bg-forest-600/10 text-forest-700 dark:text-white' : 'text-ink-900/60 dark:text-white/50 hover:text-forest-600' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
    </svg>

    @if($cartCount > 0)
        <span class="absolute -top-1 -right-1 flex items-center justify-center min-w-[18px] h-[18px] px-1 rounded-full bg-mustard-500 text-white text-[10px] font-bold animate-bounce-once">
            {{ $cartCount }}
        </span>
    @endif
</a>