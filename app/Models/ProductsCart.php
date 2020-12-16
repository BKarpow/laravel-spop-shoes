<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCart extends Model
{
    use HasFactory;

    protected  $table = 'products_cart';


    public function cart(){
        return $this->belongsTo('App\Models\Cart');
    }

    function product(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
