<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <div class="mb-10 text-center">
            <span class="inline-block bg-mustard-500/10 text-mustard-500 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide">
                Por tiempo limitado
            </span>
            <h1 class="font-display text-4xl font-semibold text-ink-900 dark:text-white mt-4">Ofertas especiales</h1>
            <p class="text-ink-900/50 dark:text-white/50 mt-2">Aprovecha estos descuentos antes de que se acaben</p>
        </div>

        @if($products->isEmpty())
            <div class="rounded-2xl border border-dashed border-stone-200 dark:border-white/15 bg-white dark:bg-white/5 p-14 text-center max-w-lg mx-auto">
                <p class="text-ink-900/60 dark:text-white/50">No hay ofertas activas en este momento. Vuelve pronto.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    @php
                        $percent = round((1 - $product->discount_price / $product->price) * 100);
                    @endphp
                    <div class="relative flex flex-col items-center justify-start overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 text-center shadow-sm hover:shadow-xl transition-all duration-300">

                        <span class="absolute top-3 left-3 z-10 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                            -{{ $percent }}%
                        </span>

                        <div class="relative mb-4 flex h-40 w-full items-center justify-center overflow-hidden rounded-xl bg-stone-50 dark:bg-white/5">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        </div>

                        <h3 class="font-semibold text-ink-900 dark:text-white">{{ $product->name }}</h3>
                        <p class="text-sm text-ink-900/50 dark:text-white/50">{{ $product->category->name }}</p>

                        <div class="flex items-center gap-2 mt-3">
                            <span class="font-display text-xl font-bold text-mustard-500">
                                S/ {{ number_format($product->discount_price, 2) }}
                            </span>
                            <span class="text-sm text-ink-900/40 dark:text-white/30 line-through">
                                S/ {{ number_format($product->price, 2) }}
                            </span>
                        </div>

                        <a href="{{ route('products.show', $product->slug) }}" class="mt-4 w-full bg-ink-900 dark:bg-forest-600 text-white text-center py-2 rounded-full hover:bg-forest-700 transition-colors text-sm font-medium">
                            Ver producto
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">{{ $products->links() }}</div>
        @endif
    </div>
</x-app-layout>