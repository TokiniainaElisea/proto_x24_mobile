<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numbering extends Model
{
    protected $fillable = [
        'order_prefix',
        'client_prefix',
        'product_prefix',
    ];
}
