<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransNotificationController extends Controller
{
    // Menerima notifikasi pembayaran dari Midtrans
    public function handle(Request $request)
    {
        try {
            $serverKey = config('services.midtrans.server_key');

            if (empty($serverKey)) {
                Log::error('Midtrans Server Key belum dikonfigurasi.');

                return response()->json([
                    'message' => 'Konfigurasi tidak tersedia.'
                ], 500);
            }

            $notification = $request->all();

            foreach ([
                'order_id',
                'status_code',
                'gross_amount',
                'signature_key',
                'transaction_id',
                'transaction_status',
            ] as $field) {
                if (!isset($notification[$field]) || $notification[$field] === '') {
                    return response()->json([
                        'message' => 'Data notifikasi tidak lengkap.'
                    ], 400);
                }
            }

            // Verifikasi signature Midtrans
            $input = $notification['order_id']
                . $notification['status_code']
                . $notification['gross_amount']
                . $serverKey;

            $expectedSignature = hash('sha512', $input);

            if (!hash_equals(
                $expectedSignature,
                (string) $notification['signature_key']
            )) {
                Log::warning('Midtrans signature tidak valid.', [
                    'order_id' => $notification['order_id'],
                ]);

                return response()->json([
                    'message' => 'Signature tidak valid.'
                ], 403);
            }

            // Memproses notifikasi secara aman dalam transaksi database
            return DB::transaction(function () use ($notification) {

                $order = Order::where(
                    'order_number',
                    $notification['order_id']
                )->lockForUpdate()->first();

                if (!$order) {
                    return response()->json([
                        'message' => 'Pesanan tidak ditemukan.'
                    ], 404);
                }

                // Memastikan nominal pembayaran sesuai
                $expectedAmount = (int) round(
                    (float) $order->orderItems()->sum('subtotal')
                );

                $receivedAmount = (int) round(
                    (float) $notification['gross_amount']
                );

                if ($expectedAmount !== $receivedAmount) {
                    Log::warning('Nominal transaksi Midtrans tidak sesuai.', [
                        'order_id' => $notification['order_id'],
                    ]);

                    return response()->json([
                        'message' => 'Nominal tidak sesuai.'
                    ], 400);
                }

                // Menyimpan ID transaksi Midtrans
                $order->midtrans_transaction_id =
                    $notification['transaction_id'];

                $transactionStatus = $notification['transaction_status'];
                $fraudStatus = $notification['fraud_status'] ?? null;
                $statusCode = (string) $notification['status_code'];

                // Jika pesanan sudah dibayar, jangan ubah statusnya lagi
                if ($order->payment_status === 'paid') {
                    return response()->json([
                        'message' => 'Pesanan sudah dibayar.'
                    ], 200);
                }

                // Pembayaran berhasil
                if (
                    $statusCode === '200' &&
                    $transactionStatus === 'settlement' &&
                    ($fraudStatus === null || $fraudStatus === 'accept')
                ) {
                    $order->payment_status = 'paid';
                    $order->order_status = 'processing';
                } elseif (
                    $statusCode === '200' &&
                    $transactionStatus === 'capture' &&
                    $fraudStatus === 'accept'
                ) {
                    $order->payment_status = 'paid';
                    $order->order_status = 'processing';
                }

                // Pembayaran masih menunggu
                elseif (
                    $transactionStatus === 'pending' &&
                    $order->payment_status !== 'failed'
                ) {
                    $order->payment_status = 'pending';
                }

                // Pembayaran gagal, dibatalkan, atau kedaluwarsa
                elseif (
                    in_array(
                        $transactionStatus,
                        ['deny', 'cancel', 'expire', 'failure']
                    )
                ) {
                    // Kembalikan stok hanya jika belum pernah dikembalikan
                    if (is_null($order->stock_restored_at)) {

                        $orderItems = $order->orderItems()
                            ->with('product')
                            ->get();

                        foreach ($orderItems as $item) {
                            if ($item->product) {
                                $item->product->increment(
                                    'stock',
                                    $item->quantity
                                );
                            }
                        }

                        // Penanda agar stok tidak dikembalikan berulang kali
                        $order->stock_restored_at = now();
                    }

                    $order->payment_status = 'failed';
                    $order->order_status = 'cancelled';
                }

                $order->save();

                return response()->json([
                    'message' => 'Notifikasi berhasil diproses.'
                ], 200);
            });

        } catch (\Exception $e) {
            Log::error(
                'Midtrans notification error: ' . $e->getMessage()
            );

            return response()->json([
                'message' => 'Gagal memproses notifikasi.'
            ], 500);
        }
    }
}
