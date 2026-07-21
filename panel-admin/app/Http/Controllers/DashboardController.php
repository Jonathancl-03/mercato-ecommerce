<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'total_revenue' => Order::sum('total'),
            'total_products' => Product::count(),
            'low_stock' => Product::where('stock', '<=', 5)->orderBy('stock')->get(),
        ];

        return view('dashboard', compact('stats'));
    }
}