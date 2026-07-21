<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $totalOrders = $orders->count();
        $totalSpent = $orders->sum('total');

        return view('orders.index', compact('orders', 'totalOrders', 'totalSpent'));
    }
}