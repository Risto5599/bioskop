<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_harga',
        'metode_pembayaran',
        'waktu_transaksi',
    ];

    public function items()
    {
        return $this->hasMany(ProductSaleItem::class);
    }
}
