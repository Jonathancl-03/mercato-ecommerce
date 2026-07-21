<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="font-display text-3xl font-semibold mb-6">Checkout</h1>

        @if($errors->any())
            <div class="bg-red-50 text-red-700 px-4 py-2 rounded mb-4 border border-red-200">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-stone-100 rounded-lg p-4 mb-6">
            <h2 class="font-display font-semibold mb-2">Resumen del pedido</h2>
            @foreach($cartItems as $item)
                <div class="flex justify-between text-sm py-1">
                    <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                    <span>S/ {{ number_format($item->product->price * $item->quantity, 2) }}</span>
                </div>
            @endforeach
            <div class="flex justify-between font-bold mt-2 pt-2 border-t border-stone-100 text-mustard-500">
                <span class="text-ink-900">Total</span>
                <span>S/ {{ number_format($total, 2) }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('checkout.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Dirección de envío</label>
                <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" class="w-full border border-stone-100 rounded px-3 py-2 focus:ring-forest-600 focus:border-forest-600" required>
            </div>

            <h2 class="font-display font-semibold pt-2">Datos de pago (simulado)</h2>

            <div>
                <label class="block text-sm font-medium mb-1">Nombre en la tarjeta</label>
                <input type="text" name="card_name" class="w-full border border-stone-100 rounded px-3 py-2 focus:ring-forest-600 focus:border-forest-600" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Número de tarjeta</label>
                <input type="text" name="card_number" maxlength="16" placeholder="4111111111111111" class="w-full border border-stone-100 rounded px-3 py-2 focus:ring-forest-600 focus:border-forest-600" required>
            </div>

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1">Vencimiento (MM/AA)</label>
                    <input type="text" name="card_expiry" placeholder="12/28" maxlength="5" class="w-full border border-stone-100 rounded px-3 py-2 focus:ring-forest-600 focus:border-forest-600" required>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1">CVV</label>
                    <input type="text" name="card_cvv" maxlength="3" class="w-full border border-stone-100 rounded px-3 py-2 focus:ring-forest-600 focus:border-forest-600" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-forest-600 text-white py-3 rounded font-semibold hover:bg-forest-700 transition-colors">
                Pagar S/ {{ number_format($total, 2) }}
            </button>
        </form>
    </div>
</x-app-layout>