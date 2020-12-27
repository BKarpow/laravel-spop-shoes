<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FullOrder extends Model
{
    use HasFactory;

    function products(){
        return $this->hasMany('App\Models\OrderProducts', 'order_id');
    }
}
