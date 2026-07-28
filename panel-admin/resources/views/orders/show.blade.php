<x-app-layout>
    <div class="max-w-3xl mx-auto">

        <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1 text-sm text-ink-900/50 dark:text-white/40 hover:text-forest-600 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            Volver a pedidos
        </a>

        @php
            $statusStyles = [
                'pendiente' => 'text-mustard-500 bg-mustard-500/10',
                'pagado' => 'text-forest-700 dark:text-forest-500 bg-forest-600/10',
                'enviado' => 'text-blue-600 bg-blue-50 dark:bg-blue-500/10',
            ];
            $badgeClass = $statusStyles[$order->status] ?? 'text-ink-900/60 bg-stone-100 dark:bg-white/10';
        @endphp

        <div class="rounded-2xl border border-stone-100 dark:border-white/10 bg-white dark:bg-ink-900 p-6 md:p-8">

            <div class="flex flex-wrap items-start justify-between gap-4 mb-6 pb-6 border-b border-stone-100 dark:border-white/10">
                <div>
                    <h1 class="font-display text-2xl font-semibold text-ink-900 dark:text-white">Pedido #{{ $order->id }}</h1>
                    <p class="text-sm text-ink-900/50 dark:text-white/40 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <span class="text-xs px-3 py-1.5 rounded-full font-medium {{ $badgeClass }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-xs uppercase tracking-wide text-ink-900/40 dark:text-white/30 font-semibold mb-2">Cliente</h3>
                    <p class="font-medium text-ink-900 dark:text-white">{{ $order->user->name }}</p>
                    <p class="text-sm text-ink-900/50 dark:text-white/40">{{ $order->user->email }}</p>
                </div>
                <div>
                    <h3 class="text-xs uppercase tracking-wide text-ink-900/40 dark:text-white/30 font-semibold mb-2">Dirección de envío</h3>
                    <p class="text-sm text-ink-900/70 dark:text-white/60">{{ $order->shipping_address }}</p>
                </div>
                @if($order->payment)
                <div>
                    <h3 class="text-xs uppercase tracking-wide text-ink-900/40 dark:text-white/30 font-semibold mb-2">Pago</h3>
                    <p class="text-sm text-ink-900/70 dark:text-white/60">{{ ucfirst($order->payment->method) }} — {{ ucfirst($order->payment->status) }}</p>
                    <p class="text-xs text-ink-900/40 dark:text-white/30">Ref: {{ $order->payment->reference }}</p>
                </div>
                @endif
            </div>

            <h3 class="text-xs uppercase tracking-wide text-ink-900/40 dark:text-white/30 font-semibold mb-3">Productos</h3>
            <div class="space-y-2 mb-6">
                @foreach($order->items as $item)
                    <div class="flex justify-between text-sm py-2 border-b border-stone-100 dark:border-white/10 last:border-0">
                        <span class="text-ink-900/80 dark:text-white/70">{{ $item->product->name }} <span class="text-ink-900/40 dark:text-white/30">x{{ $item->quantity }}</span></span>
                        <span class="text-ink-900 dark:text-white font-medium">S/ {{ number_format($item->price * $item->quantity, 2) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between items-center font-semibold text-lg pt-4 border-t border-stone-100 dark:border-white/10 mb-6">
                <span class="text-ink-900 dark:text-white">Total</span>
                <span class="text-mustard-500 font-display">S/ {{ number_format($order->total, 2) }}</span>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('orders.pdf', ['order' => $order->id, 'tipo' => 'boleta']) }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-forest-600 text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-forest-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2m10 0h2a2 2 0 012 2v10a2 2 0 01-2 2h-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7" /></svg>
                    Imprimir boleta
                </a>
                <a href="{{ route('orders.pdf', ['order' => $order->id, 'tipo' => 'factura']) }}" target="_blank"
                   class="inline-flex items-center gap-2 border border-stone-100 dark:border-white/10 text-ink-900 dark:text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-stone-50 dark:hover:bg-white/5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Imprimir factura
                </a>
            </div>
        </div>
    </div>
</x-app-layout>