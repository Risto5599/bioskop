@extends('layout.app')

@section('title', 'Laporan Penjualan')
@section('page-title', 'Laporan Penjualan Tiket & Produk')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4 d-flex justify-content-end gap-2">
        <a href="{{ route('laporan.cetak.tiket') }}" class="btn btn-danger" target="_blank">
            <i class="bi bi-printer"></i> Cetak Tiket
        </a>
        <a href="{{ route('laporan.cetak.produk') }}" class="btn btn-primary" target="_blank">
            <i class="bi bi-printer-fill"></i> Cetak Produk
        </a>
    </div>
</div>

{{-- Laporan Penjualan Tiket --}}
<div class="card mb-4">
    <div class="card-header fw-bold">Laporan Penjualan Tiket</div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Judul Film</th>
                    <th>Jumlah Tiket</th>
                    <th>Total Harga</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ticketSales as $i => $sale)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $sale->film->judul }}</td>
                    <td>{{ $sale->jumlah_tiket }}</td>
                    <td>Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $sale->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Laporan Penjualan Produk --}}
<div class="card">
    <div class="card-header fw-bold">Laporan Penjualan Produk</div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Total Harga</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productSales as $i => $sale)
                @foreach ($sale->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->nama }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $sale->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
