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
        'phone',
        'adress',
        'town',
        'pays',
        'name_contact',
        'note',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}