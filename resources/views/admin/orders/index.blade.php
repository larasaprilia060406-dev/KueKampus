<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan | KueKampus.id</title>

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
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            margin-bottom: 8px;
        }

        .description {
            color: #806e63;
            margin-bottom: 25px;
        }

        .table-wrapper {
            background: white;
            border-radius: 10px;
            padding: 20px;
            overflow-x: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee5de;
        }

        th {
            background: #f8eee6;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            background: #f3e8dc;
        }

        .detail {
            display: inline-block;
            background: #75452e;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
        }

        .empty {
            text-align: center;
            color: #806e63;
            padding: 25px;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #75452e;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ route('admin.dashboard') }}" class="back">
        &larr; Kembali ke Dashboard
    </a>

    <h1>Manajemen Pesanan</h1>
    <p class="description">
        Daftar pesanan pelanggan KueKampus.id
    </p>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status Pembayaran</th>
                    <th>Status Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name ?? 'Pengguna tidak ditemukan' }}</td>
                        <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="status">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td>
                            <span class="status">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="detail">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">
                            Belum ada pesanan pelanggan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
