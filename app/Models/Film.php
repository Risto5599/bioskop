<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'genre',
        'durasi',
        'sinopsis',
        'poster',
    ];

    public function ticketSales()
    {
        return $this->hasMany(TicketSale::class);
    }
}
