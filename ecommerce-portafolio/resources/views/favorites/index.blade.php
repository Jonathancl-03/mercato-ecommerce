<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <div class="mb-10 text-center">
            <h1 class="font-display text-4xl font-semibold text-ink-900 dark:text-white">Mis favoritos</h1>
            <p class="text-ink-900/50 dark:text-white/50 mt-2">Los productos que has guardado</p>
        </div>

        @if($favorites->isEmpty())
            <div class="rounded-2xl border border-dashed border-stone-200 dark:border-white/15 bg-white dark:bg-white/5 p-14 text-center max-w-lg mx-auto">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-50 dark:bg-red-500/10 flex items-center justify-center text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </div>
                <p class="text-ink-900/60 dark:text-white/50 mb-4">Aún no tienes productos favoritos.</p>
                <a href="{{ route('home') }}" class="inline-block bg-forest-600 text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-forest-700 transition-colors">
                    Ver catálogo
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($favorites as $fav)
                    @php $product = $fav->product; @endphp
                    <div class="relative flex flex-col items-center justify-start overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 text-center shadow-sm hover:shadow-xl transition-all duration-300">

                        <form method="POST" action="{{ route('favorites.toggle', $product->id) }}" class="absolute top-3 right-3 z-10">
                            @csrf
                            <button type="submit" class="w-9 h-9 rounded-full bg-white dark:bg-ink-900 shadow flex items-center justify-center text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21s-6.716-4.35-9.428-8.55C.936 9.75 1.5 6 4.688 4.5 7.03 3.4 9.315 4.2 10.687 6.087 12.06 4.2 14.344 3.4 16.687 4.5 19.875 6 20.44 9.75 18.803 12.45 16.09 16.65 12 21 12 21z"/>
                                </svg>
                            </button>
                        </form>

                        <div class="relative mb-4 flex h-40 w-full items-center justify-center overflow-hidden rounded-xl bg-stone-50 dark:bg-white/5">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        </div>

                        <h3 class="font-semibold text-ink-900 dark:text-white">{{ $product->name }}</h3>
                        <p class="text-sm text-ink-900/50 dark:text-white/50">{{ $product->category->name }}</p>

                        <span class="font-display text-xl font-bold text-ink-900 dark:text-white mt-3">
                            S/ {{ number_format($product->discount_price ?? $product->price, 2) }}
                        </span>

                        <a href="{{ route('products.show', $product->slug) }}" class="mt-4 w-full bg-ink-900 dark:bg-forest-600 text-white text-center py-2 rounded-full hover:bg-forest-700 transition-colors text-sm font-medium">
                            Ver producto
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>