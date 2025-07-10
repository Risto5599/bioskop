@extends('layout.app')

@section('title', 'Transaksi Produk')
@section('page-title', 'Manajemen Transaksi Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Daftar Transaksi Produk</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSaleModal">
        <i class="bi bi-plus-circle me-1"></i> Tambah Transaksi
    </button>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Detail Produk</th>
                    <th>Total Harga</th>
                    <th>Metode</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $i => $sale)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <ul class="mb-0">
                            @foreach ($sale->items as $item)
                            <li>{{ $item->product->nama }} ({{ $item->qty }}x) - Rp{{ number_format($item->subtotal, 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>Rp{{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($sale->metode_pembayaran) }}</td>
                    <td>{{ $sale->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sale->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>

                {{-- Modal Hapus --}}
                <div class="modal fade" id="deleteModal{{ $sale->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('product-sales.destroy', $sale->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus Transaksi</h5>
                                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Yakin ingin menghapus transaksi ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Transaksi --}}
<div class="modal fade" id="createSaleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('product-sales.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Transaksi Produk</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="productContainer">
                        <div class="row align-items-end mb-3">
                            <div class="col-md-6">
                                <label>Produk</label>
                                <select name="product_ids[]" class="form-select" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach(\App\Models\Product::all() as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama }} (Rp{{ number_format($product->harga, 0, ',', '.') }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Qty</label>
                                <input type="number" name="qtys[]" class="form-control" required min="1">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success addProduct w-100">
                                    <i class="bi bi-plus-circle"></i> Tambah Produk
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-select" required>
                            <option value="tunai">Tunai</option>
                            <option value="qris">QRIS</option>
                            <option value="debit">Kartu Debit</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productContainer = document.getElementById('productContainer');

        document.querySelector('.addProduct').addEventListener('click', function () {
            const row = document.createElement('div');
            row.classList.add('row', 'align-items-end', 'mb-3');
            row.innerHTML = `
                <div class="col-md-6">
                    <select name="product_ids[]" class="form-select" required>
                        <option value="">Pilih Produk</option>
                        @foreach(\App\Models\Product::all() as $product)
                        <option value="{{ $product->id }}">{{ $product->nama }} (Rp{{ number_format($product->harga, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="qtys[]" class="form-control" required min="1">
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger removeProduct w-100">
                        <i class="bi bi-x-circle"></i> Hapus
                    </button>
                </div>
            `;
            productContainer.appendChild(row);

            row.querySelector('.removeProduct').addEventListener('click', function () {
                row.remove();
            });
        });
    });
</script>
@endpush
