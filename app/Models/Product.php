<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenis',
        'harga',
        'stok',
        'gambar',
    ];

    public function saleItems()
    {
        return $this->hasMany(ProductSaleItem::class);
    }
}
