<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.product')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product', 'payment');
        return view('orders.show', compact('order'));
    }

    public function pdf(Order $order, Request $request)
    {
        $order->load('user', 'items.product', 'payment');
        $tipo = $request->query('tipo', 'boleta'); // 'boleta' o 'factura'

        $pdf = Pdf::loadView('orders.pdf', compact('order', 'tipo'))
            ->setPaper('a4', 'portrait');

        $nombreArchivo = ($tipo === 'factura' ? 'Factura' : 'Boleta') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf';

        return $pdf->stream($nombreArchivo);
    }
}