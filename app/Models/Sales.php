<?php

namespace App\Models;

use App\Models\Client;
use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'client_id',
        'status',
        'discount',
        'total_price',
        'note',
        'payment_method',
        'sale_reference'
    ];

    public function saledetail(){
        return $this->hasMany(SaleDetail::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
