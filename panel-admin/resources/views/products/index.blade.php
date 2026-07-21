<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4">

        <div class="dash-fade flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-semibold uppercase tracking-widest text-forest-600 dark:text-forest-500">Inventario</span>
                <h1 class="font-display text-3xl md:text-4xl font-semibold text-ink-900 dark:text-white mt-2">Productos</h1>
            </div>
            <a href="{{ route('productos.create') }}" data-magnetic class="inline-flex items-center gap-2 bg-forest-600 text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-forest-700 transition-colors self-start sm:self-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                Nuevo producto
            </a>
        </div>

        @if(session('success'))
            <div class="dash-fade bg-forest-600/10 text-forest-700 dark:text-forest-500 px-4 py-3 rounded-xl mb-6 border border-forest-600/20 flex items-center gap-2 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="dash-fade rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 overflow-hidden">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-stone-50 dark:bg-white/5 text-left border-b border-stone-100 dark:border-white/10">
                        <th class="p-4 text-xs font-semibold uppercase tracking-wide text-ink-900/50 dark:text-white/40">Producto</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wide text-ink-900/50 dark:text-white/40">Categoría</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wide text-ink-900/50 dark:text-white/40">Precio</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wide text-ink-900/50 dark:text-white/40">Stock</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wide text-ink-900/50 dark:text-white/40 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="border-b border-stone-100 dark:border-white/10 last:border-0 hover:bg-stone-50 dark:hover:bg-white/5 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-lg overflow-hidden bg-stone-50 dark:bg-white/5 flex-shrink-0">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-medium text-ink-900 dark:text-white">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="text-xs px-2.5 py-1 rounded-full bg-forest-600/10 text-forest-700 dark:text-forest-500 font-medium">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td class="p-4 text-mustard-500 font-semibold">S/ {{ number_format($product->price, 2) }}</td>
                            <td class="p-4">
                                <span class="text-sm font-medium {{ $product->stock <= 5 ? 'text-red-600' : 'text-ink-900 dark:text-white' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('productos.edit', $product->id) }}" class="p-2 rounded-lg hover:bg-stone-100 dark:hover:bg-white/10 text-ink-900/60 dark:text-white/50 hover:text-forest-600 transition-colors" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('productos.destroy', $product->id) }}" onsubmit="return confirm('¿Eliminar este producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-500/10 text-ink-900/60 dark:text-white/50 hover:text-red-600 transition-colors" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $products->links() }}</div>
    </div>

    <style>
        .dash-fade { opacity: 0; transform: translateY(20px); }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined') return;
            gsap.to('.dash-fade', { opacity: 1, y: 0, duration: 0.5, stagger: 0.08, ease: 'power3.out' });

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