<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TextToolTrait;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    use HasFactory, TextToolTrait;

    /**
     * Містить останніх дітей категорії
     * @var array
     */
    public array $last_children_category = [];

    /**
     * Створює нову категорію для товарів
     * @param string $title
     * @param string $description
     * @param int $image_id
     * @param int $parent_id
     * @return bool
     */
    public function addNewCategory(string $title,
                                   string $description,
                                   int $image_id,
                                    int $parent_id = 0
    ):bool
    {
        $alias = $this->getAliasFromString($title);
        $this->title = $title;
        $this->alias = $alias;
        $this->description = $description;
        $this->image_id = $image_id;
        if ($parent_id){
            $this->parent_id = $parent_id;
        }
        return (bool) $this->save();
    }


    /**
     * Фрпмує масив який підходить для використання в методі Model::where()
     * @param array $data
     * @param string $name_column
     * @return array
     */
    private function arrayFormatWhere(array $data, string $name_column = 'category_id'):array
    {
        $n_arr = [];
        foreach ($data as $datum) {
            $b_arr = [];
            $b_arr[] = $name_column;
            $b_arr[] = '=';
            $b_arr[] = (string)$datum->id;
            $n_arr[] = (string)$datum->id;
        }
        return $n_arr;
    }


    /**
     * Поаертає список дітей категорії
     * @param int $category_id
     * @return array
     */
    public function getChildrenFromCategory(int $category_id)
    {
        $result_array = (!$category_id) ? [] :  DB::table('product_categories')
            ->select('id', 'title', 'parent_id')
            ->where('parent_id', $category_id)
            ->get()
            ->toArray();
        $this->last_children_category = $result_array;
        return $this->arrayFormatWhere( $result_array);
    }


    /**
     * Перевіряє чи категорій існує
     * @param int $category_id
     * @return bool
     */
    public static function checkCategoryExists(int $category_id):bool
    {
        return (bool) DB::table('product_categories')
            ->select('id')
            ->where('id', $category_id)
            ->first();
    }

    public function getCategorySortedArray():array
    {
        $res = DB::table('product_categories')
            ->select('id', 'alias', 'title', 'parent_id')
            ->get()->toArray();
        return sorted_tree_category($res);
    }
}
