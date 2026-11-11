<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransNotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = \App\Models\Product::with('category')->get();

    return view('kuekampus', compact('products'));
});

// Katalog semua produk
Route::get('/produk', function () {
    $products = \App\Models\Product::with('category')->get();

    return view('produk.index', compact('products'));
})->name('produk.index');

// Katalog produk berdasarkan kategori
Route::get('/produk/kategori/{category}', function (\App\Models\Category $category) {
    $products = \App\Models\Product::with('category')
        ->where('category_id', $category->id)
        ->get();

    return view('produk.index', compact('products', 'category'));
})->name('produk.kategori');

// Katalog Kategori untuk Pengunjung
Route::get('/kategori', function () {
    $categories = \App\Models\Category::all();

    return view('kategori.index', compact('categories'));
})->name('kategori.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Tentang Kami
Route::view('/tentang-kami', 'tentang-kami')
    ->name('tentang-kami');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Manajemen Produk
    Route::resource('products', ProductController::class);

    // Manajemen Kategori
    Route::resource('categories', CategoryController::class);
});

// Shopping Cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::patch('/cart/update/{id}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');

    // Pembayaran Midtrans
    Route::post('/orders/{order}/pay', [PaymentController::class, 'pay'])
        ->name('orders.pay');

    // Halaman pembayaran pesanan
    Route::get('/orders/{order}/payment', [PaymentController::class, 'show'])
        ->name('orders.payment');

    // Simpan pesanan
    Route::post('/checkout', [CartController::class, 'storeOrder'])->name('checkout.store');
});

// Webhook notifikasi pembayaran Midtrans
Route::post('/midtrans/notification', [MidtransNotificationController::class, 'handle'])
    ->name('midtrans.notification');
require __DIR__ . '/auth.php';
