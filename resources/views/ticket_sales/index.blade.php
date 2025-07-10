@extends('layout.app')

@section('title', 'Transaksi Tiket')
@section('page-title', 'Manajemen Transaksi Tiket')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Daftar Transaksi Tiket</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTicketModal">
        <i class="bi bi-plus-circle me-1"></i> Tambah Transaksi
    </button>
</div>

{{-- Alert --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Tabel Transaksi --}}
<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Film</th>
                    <th>Jumlah Tiket</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $i => $sale)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $sale->film->judul }}</td>
                    <td>{{ $sale->jumlah_tiket }}</td>
                    <td>Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $sale->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sale->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>

                {{-- Modal Hapus --}}
                <div class="modal fade" id="deleteModal{{ $sale->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $sale->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('ticket-sales.destroy', $sale->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $sale->id }}">Hapus Transaksi</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Yakin ingin menghapus transaksi tiket untuk film <strong>{{ $sale->film->judul }}</strong>?</p>
                                    <p class="mb-0"><strong>Jumlah Tiket:</strong> {{ $sale->jumlah_tiket }}</p>
                                    <p><strong>Total Harga:</strong> Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</p>
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
                    <td colspan="6" class="text-center">Belum ada transaksi tiket.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Transaksi --}}
<div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby="createTicketLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('ticket-sales.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createTicketLabel">Tambah Transaksi Tiket</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Film</label>
                        <select name="film_id" class="form-select" required>
                            <option value="">Pilih Film</option>
                            @foreach($films as $film)
                            <option value="{{ $film->id }}">{{ $film->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Jumlah Tiket</label>
                        <input type="number" name="jumlah_tiket" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Total Harga</label>
                        <input type="number" name="total_harga" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
