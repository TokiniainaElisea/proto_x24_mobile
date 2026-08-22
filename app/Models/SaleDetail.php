<?php

namespace App\Models;

use App\Models\Sales;
use App\Models\Stock\Product;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
        'sales_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_line',
        'cost_price'
    ];

    public function sales(){
        return $this->belongsTo(Sales::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
