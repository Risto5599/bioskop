@extends('layout.app')

@section('title', 'Daftar Film')
@section('page-title', 'Manajemen Film')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Daftar Film</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFilmModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Film
        </button>
    </div>

    {{-- Alert --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Table Film --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Genre</th>
                        <th>Durasi (mnt)</th>
                        <th>Sinopsis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($films as $i => $film)
                        <tr>
                            <td>{{ $films->firstItem() + $i }}</td>
                            <td>{{ $film->judul }}</td>
                            <td><span class="badge bg-info">{{ $film->genre }}</span></td>
                            <td>{{ $film->durasi }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($film->sinopsis, 50) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editFilmModal{{ $film->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteFilmModal{{ $film->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editFilmModal{{ $film->id }}" tabindex="-1" aria-labelledby="editLabel{{ $film->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('films.update', $film->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title" id="editLabel{{ $film->id }}">Edit Film</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Judul</label>
                                                <input type="text" name="judul" class="form-control" value="{{ $film->judul }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Genre</label>
                                                <input type="text" name="genre" class="form-control" value="{{ $film->genre }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Durasi</label>
                                                <input type="number" name="durasi" class="form-control" value="{{ $film->durasi }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Sinopsis</label>
                                                <textarea name="sinopsis" class="form-control" rows="3" required>{{ $film->sinopsis }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button class="btn btn-warning" type="submit">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Delete Modal --}}
                        <div class="modal fade" id="deleteFilmModal{{ $film->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $film->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('films.destroy', $film->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteLabel{{ $film->id }}">Hapus Film</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin ingin menghapus <strong>{{ $film->judul }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button class="btn btn-danger" type="submit">Ya, Hapus</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data film.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $films->links() }}
            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    <div class="modal fade" id="createFilmModal" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('films.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="createLabel">Tambah Film</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Genre</label>
                            <input type="text" name="genre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Durasi</label>
                            <input type="number" name="durasi" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Sinopsis</label>
                            <textarea name="sinopsis" class="form-control" rows="3" required></textarea>
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
