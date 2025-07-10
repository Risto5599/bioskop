<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSale;
use App\Models\ProductSaleItem;
use Illuminate\Http\Request;

class ProductSaleController extends Controller
{
    public function index()
    {
        $sales = ProductSale::with('items.product')->latest()->get();
        return view('product_sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('product_sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'qtys' => 'required|array',
        ]);

        $total = 0;
        foreach ($request->product_ids as $index => $productId) {
            $product = Product::findOrFail($productId);
            $qty = $request->qtys[$index];
            $total += $product->harga * $qty;
        }

        $sale = ProductSale::create([
            'total_harga' => $total,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        foreach ($request->product_ids as $index => $productId) {
            $qty = $request->qtys[$index];
            $product = Product::findOrFail($productId);

            ProductSaleItem::create([
                'product_sale_id' => $sale->id,
                'product_id' => $product->id,
                'qty' => $qty,
                'subtotal' => $product->harga * $qty,
            ]);
        }

        return redirect()->route('product-sales.index')->with('success', 'Transaksi produk berhasil.');
    }

    public function destroy(ProductSale $productSale)
    {
        $productSale->items()->delete();
        $productSale->delete();
        return redirect()->route('product-sales.index')->with('success', 'Transaksi produk dihapus.');
    }
}
