<?php

namespace App\Models;

use App\Models\Product;
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
