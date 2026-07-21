<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">

        <div class="mb-10 text-center">
            <h1 class="font-display text-4xl font-semibold text-forest-600">Nuestro catálogo</h1>
            <p class="text-ink-900/50 mt-2">Encuentra justo lo que necesitas</p>
        </div>

        <form method="GET" class="mb-10 flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto">
            <input type="text" name="search" placeholder="Buscar productos..." value="{{ request('search') }}"
                class="border border-stone-100 rounded-full px-4 py-2.5 flex-1 focus:ring-forest-600 focus:border-forest-600">
            <select name="category" class="border border-stone-100 rounded-full px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600">
                <option value="">Todas las categorías</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-forest-600 text-white px-6 py-2.5 rounded-full hover:bg-forest-700 transition-colors font-medium">
                Filtrar
            </button>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="product-card group relative flex flex-col items-center justify-start overflow-hidden rounded-2xl border border-stone-100 bg-white p-6 text-center shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                     style="opacity: 0; transform: translateY(30px);">

                    <div class="relative mb-4 flex h-40 w-full items-center justify-center overflow-hidden rounded-xl bg-stone-50">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <div class="flex flex-grow flex-col items-center gap-1">
                        <h3 class="font-semibold text-ink-900">{{ $product->name }}</h3>
                        <p class="text-sm text-ink-900/50">{{ $product->category->name }}</p>
                    </div>

                    <div class="mt-4 flex flex-col items-center gap-2">
                        <span class="font-display text-2xl font-bold text-ink-900">
                            S/ {{ number_format($product->price, 2) }}
                        </span>

                        <div class="product-glass-pill flex items-center gap-2 rounded-full px-3 py-1 text-xs
                            {{ $product->stock <= 5 ? 'text-red-600' : 'text-forest-700' }}">
                            @if($product->stock <= 5)
                                Últimas {{ $product->stock }} unidades
                            @else
                                Stock disponible
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('products.show', $product->slug) }}" data-magnetic
                        class="mt-4 w-full bg-ink-900 text-white text-center py-2 rounded-full hover:bg-forest-700 transition-colors text-sm font-medium">
                        Ver producto
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>
    </div>
    
    <style>
        .product-glass-pill {
            background: linear-gradient(145deg, rgba(45,74,62,0.08) 0%, rgba(45,74,62,0.03) 100%);
            border: 1px solid rgba(45,74,62,0.12);
        }
        .dark .product-glass-pill {
            background: linear-gradient(145deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.02) 100%);
            border: 1px solid rgba(255,255,255,0.1);
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined') return;
            gsap.registerPlugin(ScrollTrigger);

            gsap.to('.product-card', {
                opacity: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.08,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.product-card',
                    start: 'top 90%',
                }
            });

            document.querySelectorAll('[data-magnetic]').forEach(function (el) {
                el.addEventListener('mousemove', function (e) {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    gsap.to(el, { x: x * 0.15, y: y * 0.3, duration: 0.3, ease: 'power2.out' });
                });
                el.addEventListener('mouseleave', function () {
                    gsap.to(el, { x: 0, y: 0, duration: 0.8, ease: 'elastic.out(1, 0.3)' });
                });
            });
        });
    </script>
</x-app-layout>