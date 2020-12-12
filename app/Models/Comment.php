<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Получить статью данного комментария.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
