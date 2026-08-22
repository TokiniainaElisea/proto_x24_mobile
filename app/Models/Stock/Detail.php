<?php

namespace App\Models\Stock;

use App\Models\Stock\Product;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    //
    protected $fillable = [
        'size',
        'color',
        'matter'
    ];

    public function product(){
        return $this->hasOne(Product::class);
    }
}
