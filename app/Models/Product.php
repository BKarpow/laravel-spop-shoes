<?php

namespace App\Models;

use App\Traits\TextToolTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, TextToolTrait;

    /**
     * Фориує коректний масив для відправки в json форматі
     * @param array $data
     * @return array
     */
    private function formatJsonArray(array $data):array
    {
        $new = [];
        foreach ($data as $key => $datum) {
            if ($key === 'attr'){
                $new[$key] = json_decode($datum, true);
                continue;
            }
            if ($key === 'description'){
                $new[$key] = strip_tags($datum);
                continue;
            }
            $new[$key] = $datum;
        }
        return $new;
    }

    /**
     * Метод створює новий товар в базі та повертає його ід
     * @param string $title
     * @param string $description
     * @param string $attributes
     * @param int $category_id
     * @param int $price_id
     * @param int $image_id
     * @return int
     */
    public function addNewProduct(string $title,
                                  string $description,
                                  string $attributes,
                                  int $category_id,
                                  int $price_id,
                                  int $image_id):int
    {
        $now = now();
        $res = DB::table('products')
            ->insert([
                'title' => $title,
                'alias' => $this->getAliasFromString($title),
                'description' => $description,
                'categories_set' => json_encode([$category_id]),
                'price_id' => $price_id,
                'attr' => $attributes,
                'image_id' => $image_id,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        return (int) DB::table('products')
            ->select('id')
            ->where([
                ['alias', '=', $this->getAliasFromString($title)],
                ['price_id', '=', $price_id],
                ['created_at', '=', $now],
                ['updated_at', '=', $now]
            ])
            ->first()->id;
    }

    //Ajax

    /**
     * Поаертає список товарів
     * @param int $limit
     * @param int $offset
     * @return \Illuminate\Support\Collection
     */
    public function getNewProduct(int $limit, int $offset)
    {
        return $this
            ->select('title', 'alias', 'description', 'main', 'image_a', 'image_b', 'image_c', 'attr',
                DB::raw('products.id as id'),
                DB::raw('categories_set->"$[0]" as category_id'),
                DB::raw('products.created_at as created'),
                DB::raw('prices.uan as price, prices.uan_min as price_min'))
            ->orderBy('created', 'DESC')
            ->leftJoin('prices', 'products.price_id', '=', 'prices.id')
            ->leftJoin('image_products', 'products.image_id', '=', 'image_products.id')
            ->limit($limit)
            ->offset($offset)
            ->get();
    }

    /**
     * Повертає масив одного товару або пустий масив якщо такого товару немає
     * @param int $product_id
     * @return array
     */
    public function getProductFromId(int $product_id):array
    {
        $res = (array)DB::table('products')
            ->select('title', 'alias', 'description', 'main', 'image_a', 'image_b', 'image_c', 'attr',
                DB::raw('products.id as id'),
                DB::raw('categories_set->"$[0]" as category_id'),
                DB::raw('products.created_at as created'),
                DB::raw('prices.uan as price, prices.uan_min as price_min'))
            ->orderBy('created', 'DESC')
            ->leftJoin('prices', 'products.price_id', '=', 'prices.id')
            ->leftJoin('image_products', 'products.image_id', '=', 'image_products.id')
            ->where('products.id', $product_id)
            ->first();
        return $this->formatJsonArray( $res);
    }
}
