<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    //
    protected $fillable = [
        'enter_date',
        'initial_quantity',
        'in_stock',
        'provider_price',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
