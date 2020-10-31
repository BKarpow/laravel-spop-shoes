<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    use HasFactory;

    /**
     * Створює ноаий запис зображення і повертає його id
     * @param string $main_image
     * @param string $image_a
     * @param string $image_b
     * @param string $image_c
     * @param string $image_d
     * @param string $image_e
     * @return mixed
     */
    public function addNewImage(string $main_image,
                                string $image_a = '',
                                string $image_b = '',
                                string $image_c = '',
                                string $image_d = '',
                                string $image_e = ''
    )
    {
        $now = now();
        $data_insert = [
            'main' => $main_image,
            'image_a' => $image_a,
            'image_b' => $image_b,
            'image_c' => $image_c,
            'image_d' => $image_d,
            'image_e' => $image_e,
            'other_image_set' => '[]',
            'created_at' => $now,
            'updated_at' => $now
        ];
        $this->insert($data_insert);
        return $this->select('id')->where([
            ['main', '=', $main_image],
            ['created_at', '=', $now],
            ['updated_at', '=', $now]
        ])->first()->id;
    }
}
