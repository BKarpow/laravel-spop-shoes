<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    /**
     * Створює нову ціну та поаертає люєкт зі властивістю id
     * @param float $price
     * @param float $min_price
     * @return mixed
     */
    public function addNewPrice(float $price, float $min_price = 0.0)
    {
        $now = now();
        $uan_min = ($min_price) ? $min_price : $price;
        $this->insert([
            'uan' => $price,
            'uan_min' => $uan_min,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        return $this->select('id')
            ->where([
                ['uan' ,'=', $price],
                ['uan_min' ,'=', $uan_min,],
                ['created_at' ,'=', $now,],
                ['updated_at' ,'=', $now]
            ])->first();
    }
}
