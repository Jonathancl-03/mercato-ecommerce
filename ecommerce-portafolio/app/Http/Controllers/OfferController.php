<?php

namespace App\Http\Controllers;

use App\Models\Product;

class OfferController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->whereNotNull('discount_price')
            ->paginate(12);

        return view('offers.index', compact('products'));
    }
}