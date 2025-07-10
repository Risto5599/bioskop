@extends('layout.app')

@section('title', 'Dashboard')
@section('page-title', 'Selamat Datang di Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Jumlah Film</h5>
                <p class="fs-3 fw-bold">{{ $jumlahFilm }}</p>
                <i class="bi bi-film fs-1 opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Jumlah Produk</h5>
                <p class="fs-3 fw-bold">{{ $jumlahProduk }}</p>
                <i class="bi bi-cup-hot fs-1 opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">Total Tiket Terjual</h5>
                <p class="fs-5 fw-bold">Rp {{ number_format($totalTransaksiTiket, 0, ',', '.') }}</p>
                <i class="bi bi-ticket fs-1 opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Total Penjualan Produk</h5>
                <p class="fs-5 fw-bold">Rp {{ number_format($totalTransaksiProduk, 0, ',', '.') }}</p>
                <i class="bi bi-bag-check fs-1 opacity-25"></i>
            </div>
        </div>
    </div>
</div>
@endsection
