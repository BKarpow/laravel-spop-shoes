<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    private int $set_user_id = 0;
    private int $set_cart_id = 0;
    const REL_TABLE = 'products_cart';

    public function setUserId(int $user_id):void
    {

        $this->set_user_id = $user_id;
        $this->getCart();
    }


    /**
     * Повертає обєкт корзини для користувача, якшо такої немає то створює її
     * @return mixed
     */
    private function createCart()
    {
        if (!$this->set_user_id) return false;
        $cart = $this->where('user_id', $this->set_user_id)->first();
        if (!$cart){
            $this->user_id = $this->set_user_id;
            $this->save();
            return $this->where('user_id', $this->set_user_id)->first();
        }
        return $cart;
    }


    /**
     * Повертаэ корзину для користувача
     * @return false|mixed
     */
    public function getCart()
    {
        $cart = $this->createCart();
        if ($cart){
            $this->set_cart_id = (int) $cart->id;
            return $cart;
        }
        return false;
    }

    /**
     * Додає товар до корзини користувача
     * @param int $product_id
     * @return bool
     */
    public function addProductFromCart(int $product_id)
    {

        if (!$this->set_cart_id) return false;
        $now = now();
        return DB::table(self::REL_TABLE)->insert([
            'cart_id' => $this->set_cart_id,
            'product_id' => $product_id,
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }

    /**
     * Повертає пагіновані сторінки товарів з корзини користувача
     * @return false|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getProductsFromCart()
    {


        if (!$this->set_cart_id) return false;
        return DB::table(self::REL_TABLE)
            ->select(
                DB::raw('products.id as pid, products.title as title, prices.uan as price'),
                DB::raw('products.alias as alias, image_products.main as image')
            )
            ->rightJoin('products', 'products.id', '=', 'products_cart.product_id')
            ->rightJoin('prices', 'products.price_id', '=', 'prices.id')
            ->rightJoin('image_products', 'products.image_id', '=', 'image_products.id')
            ->where('cart_id', $this->set_cart_id)->paginate(env('PER_PAGE', 15));
    }

    /**
     * Видаляє товар з корзини
     * @param int $product_id
     * @return int
     */
    public function removeProductFromCart(int $product_id)
    {
        return DB::table(self::REL_TABLE)
            ->where([
                ['cart_id', '=', $this->set_cart_id],
                ['product_id', '=', $product_id],
            ])
            ->delete();
    }

    /**
     * Перевіряє чи є товар в кощику
     * @param int $product_id
     * @return bool
     */
    public function checkProductFromCart(int $product_id)
    {
        if (!$this->set_cart_id) return false;
        return (bool) DB::table(self::REL_TABLE)
            ->where([
                ['cart_id', '=', $this->set_cart_id],
                ['product_id', '=', $product_id]
            ])
            ->first();
    }

    public function order()
    {
        return $this->belongsTo('App\Models\CartOrder');
    }

    public function products(){
        return $this->hasMany('App\Models\ProductsCart', 'cart_id');
    }

}
