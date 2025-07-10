@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-4">Manajemen Produk</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProductModal">
        <i class="bi bi-plus-circle me-1"></i> Tambah Produk
    </button>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->nama }}</td>
                    <td>
                        <span class="badge bg-{{ $product->jenis == 'makanan' ? 'success' : 'info' }}">
                            {{ ucfirst($product->jenis) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title">Edit Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nama Produk</label>
                                    <input type="text" name="nama" value="{{ $product->nama }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Jenis</label>
                                    <select name="jenis" class="form-select" required>
                                        <option value="makanan" {{ $product->jenis == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                        <option value="minuman" {{ $product->jenis == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Harga</label>
                                    <input type="number" name="harga" value="{{ $product->harga }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Stok</label>
                                    <input type="number" name="stok" value="{{ $product->stok }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-warning">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Hapus -->
                <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="modal-content">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">Hapus Produk</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Yakin ingin menghapus <strong>{{ $product->nama }}</strong>?</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada produk tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('products.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jenis</label>
                    <select name="jenis" class="form-select" required>
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
            new bootstrap.Modal(document.getElementById('createProductModal')).show();
        @endif
    });
</script>
@endpush
