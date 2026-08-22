<?php

namespace App\Models;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'title',
        'name',
        'firstname',
        'phone',
        'adress',
        'town',
        'client_number'
    ];

    public function sales(){
        return $this->hasOne(Sales::class);
    }
}
