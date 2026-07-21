<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|url',
        ]);

        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();

        Product::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado.');
    }

    public function edit(Product $producto)
    {
        $categories = Category::all();
        return view('products.edit', ['product' => $producto, 'categories' => $categories]);
    }

    public function update(Request $request, Product $producto)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|url',
        ]);

        $producto->update($data);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Product $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}