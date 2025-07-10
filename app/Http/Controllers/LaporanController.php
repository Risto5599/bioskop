<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketSale;
use App\Models\ProductSale;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $ticketSales = TicketSale::with('film')->latest()->get();
        $productSales = ProductSale::with('items.product')->latest()->get();

        return view('laporan.index', compact('ticketSales', 'productSales'));
    }

    public function cetakTiket()
{
    $sales = TicketSale::with('film')->get();
    $request = null; // atau bisa buat object dummy jika perlu
    $pdf = PDF::loadView('laporan.tiket', compact('sales', 'request'));
    return $pdf->download('laporan_tiket.pdf');
}

public function cetakProduk()
{
    $sales = ProductSale::with('items.product')->get();
    $request = null;
    $pdf = PDF::loadView('laporan.produk', compact('sales', 'request'));
    return $pdf->download('laporan_produk.pdf');
}
}
