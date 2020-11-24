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

    public function setUserId(int $user_id):void
    {
        $this->set_user_id = $user_id;
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
        $this->getCart();
        if (!$this->set_cart_id) return false;
        $now = now();
        return DB::table('products_cart')->insert([
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

        $this->getCart();
        if (!$this->set_cart_id) return false;
        return DB::table('products_cart')
            ->select(
                DB::raw('products.id as pid, products.title as title, prices.uan as price'),
                DB::raw('products.alias as alias, image_products.main as image')
            )
            ->rightJoin('products', 'products.id', '=', 'products_cart.product_id')
            ->rightJoin('prices', 'products.price_id', '=', 'prices.id')
            ->rightJoin('image_products', 'products.image_id', '=', 'image_products.id')
            ->where('cart_id', $this->set_cart_id)->paginate(env('PER_PAGE', 15));
    }
}
