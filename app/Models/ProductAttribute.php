<?php

namespace App\Models;

use App\Traits\TextToolTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductAttribute extends Model
{
    use HasFactory, TextToolTrait;

    /**
     * Метод створює новий атрибут товарів та повертає його id
     * @param string $title
     * @param string $value
     * @return int
     */
    public function addNewAttribute(string $title, string $value)
    {
        $now = now();
        $ins = [
            'title' => $title,
            'alias' => $this->getAliasFromString($title),
            'value' => $value,
            'created_at' => $now,
            'updated_at' => $now
        ];
        $whr = [
            ['title', '=', $title],
            ['alias', '=', $this->getAliasFromString($title)],
            ['value', '=', $value],
            ['created_at', '=', $now],
            ['updated_at', '=', $now]
        ];
        $this->insert($ins);
        return (int) $this->where($whr)->first()->id;
    }

    /**
     * Поаертає список всіх атрибутів
     * @return mixed
     */
    public function getAllListAttributes()
    {
        return $this->select( 'title',  'value', 'id')
            ->get();
    }

    /**
     * Створює звязок між атрибутом та товаром
     * @param int $attribute_id
     * @param int $product_id
     * @return bool
     */
    public function addAttributeFromProduct(int $attribute_id, int $product_id):bool
    {
        return (bool) DB::table('rel_attribute_product')
            ->insert([
                'attribute_id' => $attribute_id,
                'product_id' => $product_id
            ]);
    }

    /**
     * Додає атрибути до товару з json дампа який перелає форма створення товару (поле attribute_dump)
     * @param string $json_dump
     * @param int $product_id
     * @return bool
     */
    public function addAttributesFromProductAsJsonDump(string $json_dump, int $product_id):bool
    {
        $result = false;
        $dump = json_decode($json_dump, true);
        if (is_array($dump) && !empty($dump)){
            $arr_insert = [];
            foreach ($dump as $item) {
                $arr_insert[] = ['attribute_id' => (int)$item['id'], 'product_id' => $product_id];
            }
            $result = DB::table('rel_attribute_product')
                ->insert($arr_insert);
        }
        return (bool) $result;
    }

    /**
     * Повертає колекцію атрибутів до товару
     * @param int $product_id
     * @return \Illuminate\Support\Collection
     */
    public function getAttributesFromProductId(int $product_id)
    {
       return DB::table('rel_attribute_product')
            ->select(
                DB::raw('product_attributes.title as title'),
                DB::raw('product_attributes.value as value'),
            )
            ->rightJoin('product_attributes',
                'rel_attribute_product.attribute_id',
                '=',
                'product_attributes.id'
            )
            ->where('product_id', '=', $product_id)
            ->get();
    }
}
