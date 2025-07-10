<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Product;
use App\Models\TicketSale;
use App\Models\ProductSale;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahFilm = Film::count();
        $jumlahProduk = Product::count();
        $totalTransaksiTiket = TicketSale::sum('total_harga');
        $totalTransaksiProduk = ProductSale::sum('total_harga');

        return view('dashboard', compact(
            'jumlahFilm',
            'jumlahProduk',
            'totalTransaksiTiket',
            'totalTransaksiProduk'
        ));
    }
}
