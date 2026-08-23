<?php

namespace App\Models;

use App\Models\SaleDetail;
use App\Models\Category;
use App\Models\Detail;
use App\Models\Mouvement;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $fillable = [
        'name_product',
        'reference',
        'price',
        'provider_id',
        'image_path',
        'category_id',
        'detail_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function detail(){
        return $this->belongsTo(Detail::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function mouvement(){
        return $this->hasMany(Mouvement::class);
    }

    public function salesdetail(){
        return $this->hasMany(SaleDetail::class);
    }
}
