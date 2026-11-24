<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan daftar pesanan pelanggan
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // Menampilkan detail pesanan
    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product');

        return view('admin.orders.show', compact('order'));
    }

    // Memperbarui status pesanan
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:processing,shipped,completed,cancelled',
        ]);

        $order->update([
            'order_status' => $request->order_status,
        ]);

        return redirect()
            ->route('admin.orders.show', $order->id)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
