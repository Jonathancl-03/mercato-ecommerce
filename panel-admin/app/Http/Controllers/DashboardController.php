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

        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));

        $monthLabels = $months->map(fn ($d) => ucfirst($d->translatedFormat('M')));

        $monthlyRevenue = $months->map(fn ($d) => (float) Order::whereYear('created_at', $d->year)
            ->whereMonth('created_at', $d->month)
            ->sum('total'));

        $totalProducts = max($stats['total_products'], 1);
        $healthyStock = Product::where('stock', '>', 5)->count();
        $stockHealthPercent = (int) round(($healthyStock / $totalProducts) * 100);

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('dashboard', compact(
            'stats', 'monthLabels', 'monthlyRevenue', 'stockHealthPercent', 'recentOrders'
        ));
    }
}