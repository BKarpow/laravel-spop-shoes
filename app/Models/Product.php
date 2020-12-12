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
     *
     * Получить комментарии статьи блога.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

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
     * @param int $category_id
     * @param int $price_id
     * @param int $image_id
     * @return int
     */
    public function addNewProduct(string $title,
                                  string $description,
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
                'category_id' => $category_id,
                'price_id' => $price_id,
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
     * @param int $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getNewProduct(int $per_page = 4)
    {
        return $this
            ->select('title', 'alias', 'description', 'main', 'image_a', 'image_b', 'image_c',
                DB::raw('products.id as id'),
                DB::raw('category_id'),
                DB::raw('products.created_at as created'),
                DB::raw('prices.uan as price, prices.uan_min as price_min'))
            ->orderBy('created', 'DESC')
            ->leftJoin('prices', 'products.price_id', '=', 'prices.id')
            ->leftJoin('image_products', 'products.image_id', '=', 'image_products.id')
            ->paginate($per_page);
    }

    /**
     * Повертає масив одного товару або пустий масив якщо такого товару немає
     * @param int $product_id
     * @return array
     */
    public function getProductFromId(int $product_id):array
    {
        $p = $this->where('id', $product_id)->first();
        if ($p){
            $p->increment('reviews');
        }
        $res = (array)DB::table('products')
            ->select('main', 'image_a', 'image_b', 'image_c',
                DB::raw('products.title as title'),
                DB::raw('products.alias as alias'),
                DB::raw('products.description as description'),
                DB::raw('products.id as id'),
                DB::raw('category_id'),
                DB::raw('products.created_at as created'),
                DB::raw('prices.uan as price, prices.uan_min as price_min'),
                DB::raw('product_categories.title as category_title'),
                DB::raw('product_categories.parent_id as category_parent'),
            )
            ->orderBy('created', 'DESC')
            ->leftJoin('product_categories', 'product_categories.id', '=','products.category_id')
            ->leftJoin('prices', 'products.price_id', '=', 'prices.id')
            ->leftJoin('image_products', 'products.image_id', '=', 'image_products.id')
            ->where('products.id', $product_id)
            ->first();
        return $this->formatJsonArray( $res);
    }

    /**
     * Повертає пагіновані сторінуи з популярними товарами
     * @param int $count_products_from_page - кількість товарів на одні сторінці
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPopularProducts(int $count_products_from_page = 4){
        $res = DB::table('products')
            ->leftJoin('image_products', 'products.image_id', '=', 'image_products.id')
            ->leftJoin('prices', 'products.price_id', '=', 'prices.id')
            ->select('title', 'alias', 'main',
                DB::raw('products.id as id'),
                DB::raw('categories_set->"$[0]" as category_id'),
                DB::raw('products.created_at as created'),
                DB::raw('prices.uan as price, prices.uan_min as price_min'))
            ->orderBy('products.reviews', 'DESC')
            ->paginate($count_products_from_page);
        return $res;
    }


    /**
     * Поаертає список товарів для категорії
     * @param int $category_id
     * @param ProductCategory $category
     * @return mixed
     */
    public function getProductsFromCategory(int $category_id, ProductCategory $category)
    {

        $children = $category->getChildrenFromCategory($category_id);
        if (empty($children)){
            $children[] = [$category_id];
        }
        return $this
            ->select('title', 'alias', 'description', 'main', 'image_a', 'image_b', 'image_c',
                DB::raw('products.id as id'),
                DB::raw('category_id'),
                DB::raw('products.created_at as created'),
                DB::raw('prices.uan as price, prices.uan_min as price_min'))
            ->orderBy('created', 'DESC')
            ->whereIn('category_id', $children)
            ->leftJoin('prices', 'products.price_id', '=', 'prices.id')
            ->leftJoin('image_products', 'products.image_id', '=', 'image_products.id')
            ->paginate(env('PER_PAGE',  20));
    }
}
