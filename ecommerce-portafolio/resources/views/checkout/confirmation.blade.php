<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 px-4 text-center">
        <div class="bg-forest-600/10 text-forest-700 border border-forest-600/20 rounded-lg p-6 mb-6">
            <h1 class="font-display text-2xl font-semibold">¡Pedido confirmado!</h1>
            <p class="mt-2">Tu pago fue procesado correctamente.</p>
        </div>

        <div class="bg-white border border-stone-100 rounded-lg p-4 text-left">
            <p><strong>Pedido:</strong> #{{ $order->id }}</p>
            <p><strong>Referencia de pago:</strong> {{ $order->payment->reference }}</p>
            <p><strong>Dirección de envío:</strong> {{ $order->shipping_address }}</p>
            <p><strong>Total:</strong> <span class="text-mustard-500 font-bold">S/ {{ number_format($order->total, 2) }}</span></p>

            <h2 class="font-display font-semibold mt-4 mb-2">Productos</h2>
            @foreach($order->items as $item)
                <div class="flex justify-between text-sm py-1">
                    <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                    <span>S/ {{ number_format($item->price * $item->quantity, 2) }}</span>
                </div>
            @endforeach
        </div>

        <a href="{{ route('home') }}" class="inline-block mt-6 text-forest-600 underline">
            Volver al catálogo
        </a>
    </div>
</x-app-layout>