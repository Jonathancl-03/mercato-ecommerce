<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full rounded-2xl border border-stone-100 dark:border-white/10">
            <div>
                <p class="text-xs uppercase tracking-wide text-forest-600 dark:text-forest-500 font-medium">{{ $product->category->name }}</p>
                <h1 class="font-display text-3xl font-semibold mt-1 text-ink-900 dark:text-white">{{ $product->name }}</h1>

                <div class="flex items-center gap-3 mt-4">
                    @if($product->discount_price)
                        <p class="text-2xl text-mustard-500 font-bold">S/ {{ number_format($product->discount_price, 2) }}</p>
                        <p class="text-lg text-ink-900/40 dark:text-white/30 line-through">S/ {{ number_format($product->price, 2) }}</p>
                    @else
                        <p class="text-2xl text-mustard-500 font-bold">S/ {{ number_format($product->price, 2) }}</p>
                    @endif
                </div>

                <p class="mt-4 text-ink-900/70 dark:text-white/60">{{ $product->description }}</p>
                <p class="mt-2 text-sm text-ink-900/50 dark:text-white/40">Stock disponible: {{ $product->stock }}</p>

                <div class="flex items-center gap-2 mt-6">
                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex items-center gap-2 flex-1">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-full px-3 py-2 w-20 focus:ring-forest-600 focus:border-forest-600">
                        <button type="submit" data-magnetic class="bg-forest-600 text-white px-6 py-2 rounded-full hover:bg-forest-700 transition-colors flex-1">
                            Agregar al carrito
                        </button>
                    </form>

                    @auth
                        <form method="POST" action="{{ route('favorites.toggle', $product->id) }}">
                            @csrf
                            <button type="submit" class="w-11 h-11 rounded-full border border-stone-100 dark:border-white/10 flex items-center justify-center text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @if($related->isNotEmpty())
        <div class="max-w-7xl mx-auto px-4 py-16 border-t border-stone-100 dark:border-white/10 mt-10">
            <h2 class="font-display text-3xl font-semibold text-center mb-10 text-ink-900 dark:text-white">
                También te puede interesar
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($related as $item)
                    <div class="related-card relative flex flex-col items-center justify-start overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 text-center shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative mb-4 flex h-40 w-full items-center justify-center overflow-hidden rounded-xl bg-stone-50 dark:bg-white/5">
                            <img src="{{ $item->image }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-transform duration-500 hover:scale-110">
                        </div>

                        <h3 class="font-semibold text-ink-900 dark:text-white">{{ $item->name }}</h3>
                        <p class="text-sm text-ink-900/50 dark:text-white/50">{{ $item->category->name }}</p>

                        <span class="font-display text-xl font-bold text-ink-900 dark:text-white mt-3">
                            S/ {{ number_format($item->discount_price ?? $item->price, 2) }}
                        </span>

                        <a href="{{ route('products.show', $item->slug) }}" class="mt-4 w-full bg-ink-900 dark:bg-forest-600 text-white text-center py-2 rounded-full hover:bg-forest-700 transition-colors text-sm font-medium">
                            Ver producto
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined') return;
            gsap.registerPlugin(ScrollTrigger);

            gsap.set('.related-card', { opacity: 0, y: 30 });
            gsap.to('.related-card', {
                opacity: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.related-card',
                    start: 'top 90%',
                }
            });

            document.querySelectorAll('[data-magnetic]').forEach(function (el) {
                el.addEventListener('mousemove', function (e) {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    gsap.to(el, { x: x * 0.1, y: y * 0.2, duration: 0.3, ease: 'power2.out' });
                });
                el.addEventListener('mouseleave', function () {
                    gsap.to(el, { x: 0, y: 0, duration: 0.7, ease: 'elastic.out(1, 0.3)' });
                });
            });
        });
    </script>
</x-app-layout>