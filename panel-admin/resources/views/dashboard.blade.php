<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4">

        <div class="mb-10 dash-fade">
            <span class="text-xs font-semibold uppercase tracking-widest text-forest-600 dark:text-forest-500">Panel de control</span>
            <h1 class="font-display text-4xl font-semibold text-ink-900 dark:text-white mt-2">Resumen general</h1>
            <p class="text-ink-900/50 dark:text-white/50 mt-2">Vista rápida del estado de tu tienda</p>
        </div>

        <!-- Tarjetas de estadísticas -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10">

            <div class="dash-fade relative overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6">
                <div class="absolute top-0 left-0 w-1 h-full bg-forest-600"></div>
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-ink-900/50 dark:text-white/40">Pedidos totales</p>
                        <p class="font-display text-3xl font-semibold mt-2 text-ink-900 dark:text-white">{{ $stats['total_orders'] }}</p>
                    </div>
                    <div class="w-11 h-11 rounded-full bg-forest-600/10 flex items-center justify-center text-forest-600 dark:text-forest-500 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                        </svg>
                    </div>
                </div>
                <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1 text-xs font-medium text-forest-600 hover:underline mt-4">
                    Ver todos
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>

            <div class="dash-fade relative overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6">
                <div class="absolute top-0 left-0 w-1 h-full bg-mustard-500"></div>
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-ink-900/50 dark:text-white/40">Ingresos totales</p>
                        <p class="font-display text-3xl font-semibold mt-2 text-mustard-500">S/ {{ number_format($stats['total_revenue'], 2) }}</p>
                    </div>
                    <div class="w-11 h-11 rounded-full bg-mustard-500/10 flex items-center justify-center text-mustard-500 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2m0-2c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-ink-900/40 dark:text-white/30 mt-4">Acumulado de todas las ventas</p>
            </div>

            <div class="dash-fade relative overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6">
                <div class="absolute top-0 left-0 w-1 h-full bg-ink-900 dark:bg-white"></div>
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-ink-900/50 dark:text-white/40">Productos activos</p>
                        <p class="font-display text-3xl font-semibold mt-2 text-ink-900 dark:text-white">{{ $stats['total_products'] }}</p>
                    </div>
                    <div class="w-11 h-11 rounded-full bg-ink-900/5 dark:bg-white/10 flex items-center justify-center text-ink-900 dark:text-white flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <a href="{{ route('productos.index') }}" class="inline-flex items-center gap-1 text-xs font-medium text-forest-600 hover:underline mt-4">
                    Gestionar productos
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
        </div>

        <!-- Accesos rápidos -->
        <div class="dash-fade flex flex-wrap gap-3 mb-10">
            <a href="{{ route('productos.create') }}" data-magnetic class="inline-flex items-center gap-2 bg-forest-600 text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-forest-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                Nuevo producto
            </a>
            <a href="{{ route('orders.index') }}" data-magnetic class="inline-flex items-center gap-2 border border-stone-100 dark:border-white/10 text-ink-900 dark:text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-stone-50 dark:hover:bg-white/5 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                Ver pedidos
            </a>
            @if(config('app.store_url'))
                <a href="{{ config('app.store_url') }}" target="_blank" data-magnetic class="inline-flex items-center gap-2 border border-stone-100 dark:border-white/10 text-ink-900 dark:text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-stone-50 dark:hover:bg-white/5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    Ver tienda
                </a>
            @endif
        </div>

        <!-- Stock bajo -->
        <div class="dash-fade rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 overflow-hidden">
            <div class="p-5 border-b border-stone-100 dark:border-white/10 flex justify-between items-center">
                <div>
                    <h3 class="font-semibold text-ink-900 dark:text-white">Stock bajo</h3>
                    <p class="text-xs text-ink-900/40 dark:text-white/30 mt-0.5">Productos con 5 unidades o menos</p>
                </div>
                <a href="{{ route('productos.index') }}" class="text-sm text-forest-600 hover:underline whitespace-nowrap">
                    Gestionar productos →
                </a>
            </div>

            @if($stats['low_stock']->isEmpty())
                <div class="p-8 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-forest-600/10 flex items-center justify-center text-forest-600 dark:text-forest-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-ink-900/50 dark:text-white/40 text-sm">Todo el inventario tiene stock saludable.</p>
                </div>
            @else
                @foreach($stats['low_stock'] as $product)
                    @php $percent = min(100, ($product->stock / 5) * 100); @endphp
                    <div class="flex items-center gap-4 p-5 border-b border-stone-100 dark:border-white/10 last:border-0">
                        <span class="flex-1 text-sm font-medium text-ink-900 dark:text-white">{{ $product->name }}</span>
                        <div class="w-32 h-1.5 bg-stone-100 dark:bg-white/10 rounded-full overflow-hidden hidden sm:block">
                            <div class="h-full bg-red-500 rounded-full" style="width: {{ $percent }}%"></div>
                        </div>
                        <span class="text-red-600 font-semibold text-sm w-28 text-right">{{ $product->stock }} unidades</span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <style>
        .dash-fade { opacity: 0; transform: translateY(20px); }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined') return;

            gsap.to('.dash-fade', {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.08,
                ease: 'power3.out'
            });

            document.querySelectorAll('[data-magnetic]').forEach(function (el) {
                el.addEventListener('mousemove', function (e) {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    gsap.to(el, { x: x * 0.15, y: y * 0.2, duration: 0.3, ease: 'power2.out' });
                });
                el.addEventListener('mouseleave', function () {
                    gsap.to(el, { x: 0, y: 0, duration: 0.7, ease: 'elastic.out(1, 0.3)' });
                });
            });
        });
    </script>
</x-app-layout>