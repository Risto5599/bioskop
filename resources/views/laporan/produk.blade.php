<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Produk</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Produk</h2>
    <p>Periode: Semua Data</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $i => $sale)
                @foreach ($sale->items as $item)
                <tr>
                    <td>{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                    <td>{{ $item->product->nama }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
