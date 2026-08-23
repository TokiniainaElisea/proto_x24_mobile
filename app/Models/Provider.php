<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
    protected $fillable = [
        'name_provider',
        'mail',
        'phone'
    ];

    public function product(){
        return $this->hasOne(Product::class);
    }
}
