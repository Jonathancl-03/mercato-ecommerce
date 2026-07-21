<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.product')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }
}