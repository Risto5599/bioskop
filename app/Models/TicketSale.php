<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'jumlah_tiket',
        'total_harga',
        'metode_pembayaran',
        'waktu_transaksi',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
