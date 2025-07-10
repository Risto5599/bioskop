<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_sale_id',
        'product_id',
        'qty',
        'subtotal',
    ];

    public function sale()
    {
        return $this->belongsTo(ProductSale::class, 'product_sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
