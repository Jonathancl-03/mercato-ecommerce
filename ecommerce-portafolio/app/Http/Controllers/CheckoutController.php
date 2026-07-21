<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'card_number' => 'required|digits:16',
            'card_name' => 'required|string|max:255',
            'card_expiry' => 'required|string|max:5',
            'card_cvv' => 'required|digits:3',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Crear el pedido
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pagado',
            'shipping_address' => $request->shipping_address,
        ]);

        // Copiar items del carrito al pedido
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            // Descontar stock
            $item->product->decrement('stock', $item->quantity);
        }

        // Simular el pago (siempre "aprobado" para el portafolio)
        Payment::create([
            'order_id' => $order->id,
            'method' => 'tarjeta',
            'status' => 'aprobado',
            'reference' => 'PAY-' . strtoupper(Str::random(10)),
        ]);

        // Vaciar el carrito
        CartItem::where('user_id', auth()->id())->delete();

        return redirect()->route('checkout.confirmation', $order->id);
    }

    public function confirmation(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product', 'payment');

        return view('checkout.confirmation', compact('order'));
    }
}