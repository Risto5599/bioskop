<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Tiket</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Tiket</h2>
    <p>Periode: Semua Data</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Film</th>
                <th>Jumlah Tiket</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $i => $sale)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $sale->film->judul }}</td>
                <td>{{ $sale->jumlah_tiket }}</td>
                <td>Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                <td>{{ $sale->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
