<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class PaymentController extends Controller
{
    // Menampilkan halaman pembayaran pesanan
    public function show(Order $order)
    {
        // Memastikan pesanan milik user yang sedang login
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // Mengambil detail item pesanan
        $order->load('orderItems.product');

        return view('payment.show', compact('order'));
    }

    // Memproses pembayaran pesanan melalui Midtrans
    public function pay(Order $order)
    {
        // Memastikan pesanan milik user yang sedang login
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // Memastikan pesanan belum dibayar
        if ($order->payment_status === 'paid') {
            return back()->with('error', 'Pesanan ini sudah dibayar.');
        }

        // Memastikan pesanan belum dibatalkan atau gagal
        if ($order->payment_status === 'failed') {
            return back()->with(
                'error',
                'Pesanan ini tidak dapat dibayar lagi.'
            );
        }

        // Mengambil detail pesanan
        $order->load('orderItems.product', 'user');

        // Memastikan konfigurasi Midtrans tersedia
        $serverKey = config('services.midtrans.server_key');

        if (empty($serverKey)) {
            return back()->with(
                'error',
                'Konfigurasi pembayaran belum tersedia.'
            );
        }

        // Konfigurasi Midtrans
        Config::$serverKey = $serverKey;
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        try {
            // Mengecek status transaksi jika Snap Token sudah tersimpan
            if ($order->midtrans_snap_token) {
                $status = Transaction::status($order->order_number);

                $transactionStatus = data_get(
                    $status,
                    'transaction_status'
                );

                $fraudStatus = data_get($status, 'fraud_status');

                // Jika pembayaran berhasil
                if (
                    $transactionStatus === 'settlement' ||
                    (
                        $transactionStatus === 'capture' &&
                        $fraudStatus === 'accept'
                    )
                ) {
                    $order->update([
                        'payment_status' => 'paid',
                        'order_status' => 'processing',
                    ]);

                    return redirect()
                        ->route('orders.payment', $order)
                        ->with('success', 'Pembayaran pesanan berhasil.');
                }

                // Jika transaksi masih menunggu pembayaran
                if ($transactionStatus === 'pending') {
                    $snapUrl = Config::$isProduction
                        ? 'https://app.midtrans.com/snap/v2/vtweb/'
                        : 'https://app.sandbox.midtrans.com/snap/v2/vtweb/';

                    return redirect(
                        $snapUrl . $order->midtrans_snap_token
                    );
                }

                // Jika transaksi ditolak, dibatalkan, atau kedaluwarsa
                if (
                    in_array(
                        $transactionStatus,
                        ['deny', 'cancel', 'expire', 'failure']
                    )
                ) {
                    $order->update([
                        'payment_status' => 'failed',
                        'order_status' => 'cancelled',
                    ]);

                    return back()->with(
                        'error',
                        'Transaksi sebelumnya gagal atau kedaluwarsa.'
                    );
                }

                // Jika status belum dapat dipastikan
                return back()->with(
                    'error',
                    'Status pembayaran belum dapat dipastikan. Silakan coba kembali nanti.'
                );
            }

            // Memastikan pesanan memiliki item
            if ($order->orderItems->isEmpty()) {
                return back()->with(
                    'error',
                    'Pesanan tidak memiliki produk untuk dibayar.'
                );
            }

            // Menyiapkan detail produk
            $items = [];

            foreach ($order->orderItems as $item) {
                $items[] = [
                    'id' => $item->product_id,
                    'price' => (int) round($item->price),
                    'quantity' => $item->quantity,
                    'name' => substr(
                        $item->product->name ?? 'Produk',
                        0,
                        50
                    ),
                ];
            }

            // Menghitung total seluruh item pesanan
            $grossAmount = (int) round(
                $order->orderItems->sum('subtotal')
            );

            // Parameter transaksi Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => $grossAmount,
                ],
                'item_details' => $items,
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'shipping_address' => [
                        'address' => $order->shipping_address,
                    ],
                ],
            ];

            // Membuat transaksi Midtrans
            $transaction = Snap::createTransaction($params);

            // Menyimpan Snap Token
            $order->update([
                'midtrans_snap_token' => $transaction->token,
            ]);

            return redirect($transaction->redirect_url);
        } catch (\Exception $e) {
            Log::error('PHP SSL configuration', [
                'php_ini' => php_ini_loaded_file(),
                'curl_cainfo' => ini_get('curl.cainfo'),
                'openssl_cafile' => ini_get('openssl.cafile'),
            ]);
            
            Log::error(
                'Midtrans payment error: ' . $e->getMessage()
            );

            return back()->with(
                'error',
                'Gagal membuat pembayaran. Silakan coba kembali.'
            );
        }
    }
}
