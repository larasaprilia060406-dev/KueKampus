<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan | KueKampus.id</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #fffaf5;
            color: #49352b;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #75452e;
            text-decoration: none;
        }

        h1 {
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
        }

        h2 {
            font-size: 18px;
            margin-bottom: 18px;
        }

        .info p {
            margin-bottom: 12px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 13px;
            text-align: left;
            border-bottom: 1px solid #eee5de;
        }

        th {
            background: #f8eee6;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 18px;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #f3e8dc;
            font-size: 13px;
        }

        .table-wrapper {
            overflow-x: auto;
        }
    </style>
</head>

<body>

    <div class="container">

        <a href="{{ route('admin.orders.index') }}" class="back">
            &larr; Kembali ke Daftar Pesanan
        </a>

        <h1>Detail Pesanan</h1>

        <div class="card info">
            <h2>Informasi Pesanan</h2>

            <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
            <p><strong>Nama Pelanggan:</strong> {{ $order->user->name ?? 'Pengguna tidak ditemukan' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? '-' }}</p>
            <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
            <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
            <p><strong>Status Pembayaran:</strong>
                <span class="status">{{ ucfirst($order->payment_status) }}</span>
            </p>
            <p><strong>Status Pesanan Saat Ini:</strong>
                <span class="status">{{ ucfirst($order->order_status) }}</span>
            </p>

            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee5de;">

            <h2>Perbarui Status Pesanan</h2>

            @if (session('success'))
            <p style="color: green; margin-bottom: 15px;">
                {{ session('success') }}
            </p>
            @endif

            <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                method="POST">

                @csrf
                @method('PATCH')

                <select name="order_status"
                    required
                    style="padding: 10px; border: 1px solid #d8c8bc; border-radius: 5px; margin-right: 10px;">

                    <option value="processing"
                        {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                        Diproses
                    </option>

                    <option value="shipped"
                        {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                        Dikirim
                    </option>

                    <option value="completed"
                        {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="cancelled"
                        {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>

                </select>

                <button type="submit"
                    style="padding: 10px 16px; background: #75452e; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Simpan Status
                </button>

                @error('order_status')
                <p style="color: red; margin-top: 10px;">{{ $message }}</p>
                @enderror

            </form>
        </div>

        <div class="card">
            <h2>Produk yang Dipesan</h2>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($order->orderItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->product->name ?? 'Produk tidak ditemukan' }}</td>
                            <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Tidak ada detail produk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p class="total">
                Total Pesanan:
                Rp{{ number_format($order->total_amount, 0, ',', '.') }}
            </p>
        </div>

    </div>

</body>

</html>