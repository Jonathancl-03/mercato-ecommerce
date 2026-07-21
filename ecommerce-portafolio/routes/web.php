<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OfferController;

use App\Models\Product;

Route::get('/', function () {
    $featured = Product::with('category')->inRandomOrder()->take(4)->get();
    $spotlight = Product::with('category')->inRandomOrder()->first();
    return view('welcome', compact('featured', 'spotlight'));
})->name('welcome');

Route::get('/tienda', [ProductController::class, 'index'])->name('home');
Route::get('/productos/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/ofertas', [OfferController::class, 'index'])->name('offers.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrito/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/carrito/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/carrito/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/pedidos/{order}/confirmacion', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
    Route::get('/mis-pedidos', [OrderController::class, 'index'])->name('orders.index');

    Route::post('/favoritos/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favoritos', [FavoriteController::class, 'index'])->name('favorites.index');
});





require __DIR__ . '/auth.php';