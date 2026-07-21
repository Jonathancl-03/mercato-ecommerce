<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4">

        <div class="dash-fade mb-8">
            <span class="text-xs font-semibold uppercase tracking-widest text-forest-600 dark:text-forest-500">Ventas</span>
            <h1 class="font-display text-3xl md:text-4xl font-semibold text-ink-900 dark:text-white mt-2">Pedidos</h1>
            <p class="text-ink-900/50 dark:text-white/50 mt-2">Todos los pedidos realizados por tus clientes</p>
        </div>

        @if($orders->isEmpty())
            <div class="dash-fade rounded-2xl border border-dashed border-stone-200 dark:border-white/15 bg-white dark:bg-white/5 p-14 text-center">
                <p class="text-ink-900/50 dark:text-white/40">Aún no hay pedidos registrados.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    @php
                        $statusStyles = [
                            'pendiente' => 'text-mustard-500 bg-mustard-500/10',
                            'pagado' => 'text-forest-700 dark:text-forest-500 bg-forest-600/10',
                            'enviado' => 'text-blue-600 bg-blue-50 dark:bg-blue-500/10',
                        ];
                        $badgeClass = $statusStyles[$order->status] ?? 'text-ink-900/60 bg-stone-100 dark:bg-white/10';
                    @endphp

                    <div class="dash-fade rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 hover:shadow-lg transition-all duration-300">
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-forest-600/10 dark:bg-forest-600/20 text-forest-700 dark:text-forest-500 flex items-center justify-center font-display font-semibold text-sm flex-shrink-0">
                                    #{{ $order->id }}
                                </div>
                                <div>
                                    <p class="font-semibold text-ink-900 dark:text-white">{{ $order->user->name }}</p>
                                    <p class="text-xs text-ink-900/50 dark:text-white/40">{{ $order->created_at->format('d M Y, H:i') }} · {{ $order->shipping_address }}</p>
                                </div>
                            </div>

                            <span class="text-xs px-3 py-1.5 rounded-full font-medium {{ $badgeClass }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="border-t border-stone-100 dark:border-white/10 pt-4 space-y-2">
                            @foreach($order->items as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-ink-900/70 dark:text-white/60">{{ $item->product->name }} <span class="text-ink-900/40 dark:text-white/30">x{{ $item->quantity }}</span></span>
                                    <span class="text-ink-900 dark:text-white/80">S/ {{ number_format($item->price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center font-semibold mt-4 pt-4 border-t border-stone-100 dark:border-white/10">
                            <span class="text-ink-900 dark:text-white">Total</span>
                            <span class="text-mustard-500 font-display text-lg">S/ {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">{{ $orders->links() }}</div>
        @endif
    </div>

    <style>
        .dash-fade { opacity: 0; transform: translateY(20px); }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined') return;
            gsap.to('.dash-fade', { opacity: 1, y: 0, duration: 0.5, stagger: 0.08, ease: 'power3.out' });
        });
    </script>
</x-app-layout>