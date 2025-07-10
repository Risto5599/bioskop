<?php

namespace App\Http\Controllers;

use App\Models\TicketSale;
use App\Models\Film;
use Illuminate\Http\Request;

class TicketSaleController extends Controller
{
    public function index()
    {
        $sales = TicketSale::with('film')->latest()->get();
        return view('ticket_sales.index', compact('sales'));
    }

    public function create()
    {
        $films = Film::all();
        return view('ticket_sales.create', compact('films'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'jumlah_tiket' => 'required|integer|min:1',
            'total_harga' => 'required|integer',
        ]);

        TicketSale::create($request->all());

        return redirect()->route('ticket-sales.index')->with('success', 'Transaksi tiket berhasil ditambahkan.');
    }

    public function destroy(TicketSale $ticketSale)
    {
        $ticketSale->delete();
        return redirect()->route('ticket-sales.index')->with('success', 'Transaksi tiket dihapus.');
    }
}
