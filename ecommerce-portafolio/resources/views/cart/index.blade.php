<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4"
        x-data="cartPage({
            items: {{ Js::from($cartItems->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->product->name,
                'category' => $item->product->category->name,
                'image' => $item->product->image,
                'price' => (float) $item->product->price,
                'quantity' => $item->quantity,
                'stock' => $item->product->stock,
            ])->values()) }},
            total: {{ (float) $total }}
        })">

        <h1 class="font-display text-3xl font-semibold mb-6">Mi carrito</h1>

        <div x-show="flashMessage" x-transition class="bg-forest-600/10 text-forest-700 px-4 py-2 rounded mb-4 border border-forest-600/20" x-text="flashMessage" style="display: none;"></div>

        <template x-if="items.length === 0">
            <div class="bg-white border border-dashed border-stone-100 rounded-xl p-10 text-center">
                <p class="text-ink-900/60 mb-2">Tu carrito está vacío.</p>
                <a href="{{ route('home') }}" class="text-forest-600 underline">Ver catálogo</a>
            </div>
        </template>

        <div x-show="items.length > 0" class="flex flex-col lg:flex-row gap-6">

            <!-- Lista de productos -->
            <div class="flex-1 space-y-3">
                <template x-for="item in items" :key="item.id">
                    <div class="p-4 rounded-xl bg-white border border-stone-100 hover:border-stone-200 transition-colors" x-transition>
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="relative w-14 h-14 rounded-lg overflow-hidden bg-stone-50 flex-shrink-0">
                                    <img :src="item.image" :alt="item.name" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h3 class="text-sm font-medium text-ink-900 truncate" x-text="item.name"></h3>
                                        <span class="px-2 py-0.5 text-xs rounded-full bg-stone-100 text-ink-900/60 whitespace-nowrap" x-text="item.category"></span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-ink-900/50 mt-0.5">
                                        <span x-text="'S/ ' + item.price.toFixed(2)"></span>
                                        <span>·</span>
                                        <span x-text="'Stock: ' + item.stock"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 flex-shrink-0">
                                <div class="flex items-center gap-1 bg-stone-50 rounded-lg p-1">
                                    <button @click="updateQuantity(item, item.quantity - 1)" :disabled="item.quantity <= 1"
                                        class="p-1.5 rounded-md hover:bg-stone-200 transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                                        </svg>
                                    </button>

                                    <span class="text-sm text-ink-900 w-6 text-center font-medium" x-text="item.quantity"></span>

                                    <button @click="updateQuantity(item, item.quantity + 1)" :disabled="item.quantity >= item.stock"
                                        class="p-1.5 rounded-md hover:bg-stone-200 transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>

                                <span class="text-sm font-semibold text-mustard-500 w-20 text-right transition-all duration-300"
                                    :class="item.flash ? 'scale-125' : 'scale-100'"
                                    x-text="'S/ ' + (item.price * item.quantity).toFixed(2)"></span>

                                <button @click="removeItem(item)" class="p-1.5 rounded-md hover:bg-red-50 text-ink-900/30 hover:text-red-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Resumen fijo -->
            <div class="w-full lg:w-80 flex-shrink-0">
                <div class="p-4 rounded-xl bg-white border border-stone-100 sticky top-4">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-ink-900/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h2 class="text-sm font-medium text-ink-900">
                            Carrito (<span x-text="totalCount"></span>)
                        </h2>
                    </div>

                    <div class="space-y-2 mb-4 max-h-64 overflow-y-auto">
                        <template x-for="item in items" :key="'sum-' + item.id">
                            <div class="flex justify-between text-xs text-ink-900/60 py-1">
                                <span class="truncate pr-2" x-text="item.name + ' x' + item.quantity"></span>
                                <span class="flex-shrink-0" x-text="'S/ ' + (item.price * item.quantity).toFixed(2)"></span>
                            </div>
                        </template>
                    </div>

                    <div class="pt-3 border-t border-stone-100">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-ink-900">Total</span>
                            <span class="text-base font-semibold text-mustard-500 inline-block transition-transform duration-300"
                                :class="totalFlash ? 'scale-125' : 'scale-100'"
                                x-text="'S/ ' + displayTotal.toFixed(2)"></span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="w-full flex items-center justify-center gap-2 bg-forest-600 hover:bg-forest-700 text-white py-2.5 rounded-lg font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Ir a pagar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cartPage({ items, total }) {
            return {
                items,
                displayTotal: total,
                totalFlash: false,
                flashMessage: null,

                get totalCount() {
                    return this.items.reduce((sum, i) => sum + i.quantity, 0);
                },

                animateTotal(newTotal) {
                    const start = this.displayTotal;
                    const end = newTotal;
                    const duration = 350;
                    const startTime = performance.now();
                    this.totalFlash = true;

                    const step = (now) => {
                        const progress = Math.min((now - startTime) / duration, 1);
                        this.displayTotal = start + (end - start) * progress;
                        if (progress < 1) {
                            requestAnimationFrame(step);
                        } else {
                            this.displayTotal = end;
                            setTimeout(() => { this.totalFlash = false; }, 150);
                        }
                    };
                    requestAnimationFrame(step);
                },

                async updateQuantity(item, newQuantity) {
                    if (newQuantity < 1 || newQuantity > item.stock) return;

                    item.flash = true;
                    setTimeout(() => { item.flash = false; }, 300);

                    try {
                        const res = await fetch(`/carrito/${item.id}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({ quantity: newQuantity }),
                        });

                        const data = await res.json();
                        item.quantity = data.quantity;
                        this.animateTotal(data.total);
                    } catch (e) {
                        console.error('Error actualizando cantidad', e);
                    }
                },

                async removeItem(item) {
                    try {
                        const res = await fetch(`/carrito/${item.id}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                        });

                        const data = await res.json();
                        this.items = this.items.filter(i => i.id !== item.id);
                        this.animateTotal(data.total);
                        this.flashMessage = 'Producto eliminado del carrito.';
                        setTimeout(() => { this.flashMessage = null; }, 2500);
                    } catch (e) {
                        console.error('Error eliminando producto', e);
                    }
                },
            };
        }
    </script>
</x-app-layout>