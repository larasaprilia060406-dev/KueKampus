<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan keranjang belanja
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    // Menambahkan produk ke keranjang
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if ($product->stock <= 0) {
            return back()->with('error', 'Maaf, stok produk sedang habis.');
        }

        $currentQuantity = $cart[$id]['quantity'] ?? 0;

        if ($currentQuantity >= $product->stock) {
            return back()->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Mengubah jumlah produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia. Stok saat ini: ' . $product->stock);
        }

        $cart[$id]['quantity'] = $request->quantity;

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    // Menghapus produk dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    // Menampilkan halaman checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja masih kosong.');
        }

        return view('checkout.index', compact('cart'));
    }

    // Menyimpan pesanan
    public function storeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:10',
            'notes' => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja masih kosong.');
        }

        try {
            DB::transaction(function () use ($cart, $request) {

                $total = 0;
                $products = [];

                foreach ($cart as $id => $item) {
                    $product = \App\Models\Product::lockForUpdate()->findOrFail($id);

                    if ($item['quantity'] > $product->stock) {
                        throw new \Exception(
                            'Stok produk ' . $product->name . ' tidak mencukupi.'
                        );
                    }

                    $subtotal = $product->price * $item['quantity'];
                    $total += $subtotal;

                    $products[] = [
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'subtotal' => $subtotal,
                    ];
                }

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'order_number' => 'KK-' . now()->format('YmdHis') . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
                    'total_amount' => $total,
                    'payment_status' => 'pending',
                    'order_status' => 'pending',
                    'shipping_address' => $request->shipping_address,
                ]);

                foreach ($products as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product']->id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal'],
                    ]);

                    $item['product']->decrement('stock', $item['quantity']);
                }
            });

            session()->forget('cart');

            return redirect()->route('produk.index')
                ->with('success', 'Pesanan berhasil dibuat. Silakan lanjutkan proses pembayaran.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
