<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">

        <div class="mb-10 text-center order-fade">
            <h1 class="font-display text-4xl font-semibold text-ink-900 dark:text-white">Mis pedidos</h1>
            <p class="text-ink-900/50 dark:text-white/50 mt-2">Revisa el estado y detalle de tus compras</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
            <div class="order-fade relative overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6">
                <div class="absolute top-0 left-0 w-1 h-full bg-forest-600"></div>
                <p class="text-xs uppercase tracking-wide text-ink-900/50 dark:text-white/40">Pedidos realizados</p>
                <p class="font-display text-3xl font-semibold mt-2 text-ink-900 dark:text-white">{{ $totalOrders }}</p>
            </div>
            <div class="order-fade relative overflow-hidden rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6">
                <div class="absolute top-0 left-0 w-1 h-full bg-mustard-500"></div>
                <p class="text-xs uppercase tracking-wide text-ink-900/50 dark:text-white/40">Total gastado</p>
                <p class="font-display text-3xl font-semibold mt-2 text-mustard-500">S/ {{ number_format($totalSpent, 2) }}</p>
            </div>
        </div>

        @if($orders->isEmpty())
            <div class="order-fade relative overflow-hidden rounded-2xl border border-dashed border-stone-200 dark:border-white/15 bg-white dark:bg-white/5 p-14 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-forest-600/10 flex items-center justify-center text-forest-600 dark:text-forest-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <p class="text-ink-900/60 dark:text-white/50 mb-4">Aún no tienes pedidos.</p>
                <a href="{{ route('home') }}" data-magnetic class="inline-block bg-forest-600 text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-forest-700 transition-colors">
                    Ver catálogo
                </a>
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

                    <div class="order-fade order-card rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 transition-all duration-300 hover:shadow-lg">
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-forest-600/10 dark:bg-forest-600/20 text-forest-700 dark:text-forest-500 flex items-center justify-center font-display font-semibold text-sm">
                                    #{{ $order->id }}
                                </div>
                                <div>
                                    <p class="font-semibold text-ink-900 dark:text-white">Pedido #{{ $order->id }}</p>
                                    <p class="text-xs text-ink-900/50 dark:text-white/40">{{ $order->created_at->format('d M Y, H:i') }}</p>
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
        @endif
    </div>

    <style>
        .order-fade, .order-card { opacity: 0; transform: translateY(24px); }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined') return;
            gsap.registerPlugin(ScrollTrigger);

            gsap.to('.order-fade', {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.08,
                ease: 'power3.out'
            });

            gsap.to('.order-card', {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.08,
                delay: 0.2,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.order-card',
                    start: 'top 90%',
                }
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