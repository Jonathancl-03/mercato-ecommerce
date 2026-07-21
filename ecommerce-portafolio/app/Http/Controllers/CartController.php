<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cartItem->product->stock,
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'item_id' => $cartItem->id,
                'quantity' => $cartItem->quantity,
                'subtotal' => round($cartItem->quantity * $cartItem->product->price, 2),
                'total' => round($this->cartTotal(), 2),
                'count' => $this->cartCount(),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cantidad actualizada.');
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'total' => round($this->cartTotal(), 2),
                'count' => $this->cartCount(),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }

    private function cartTotal(): float
    {
        return CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get()
            ->sum(fn($item) => $item->product->price * $item->quantity);
    }

    private function cartCount(): int
    {
        return (int) CartItem::where('user_id', auth()->id())->sum('quantity');
    }

    private function authorizeCartItem(CartItem $cartItem): void
    {
        if ($cartItem->user_id !== auth()->id()) {
            abort(403);
        }
    }
}