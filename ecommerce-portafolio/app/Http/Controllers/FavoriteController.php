<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('product.category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request, Product $product)
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $isFavorite = false;
        } else {
            Favorite::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ]);
            $isFavorite = true;
        }

        if ($request->wantsJson()) {
            return response()->json(['is_favorite' => $isFavorite]);
        }

        return back();
    }
}