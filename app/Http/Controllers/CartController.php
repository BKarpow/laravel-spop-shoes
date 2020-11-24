<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //ajax
    function ajax_get_products_from_cart(){
        $cart = new Cart();
        $cart->setUserId(auth()->user()->id);
        return response()->json(['data'=>$cart->getProductsFromCart()]);
    }

    function ajax_add_to_cart(Request $request){
        $pid = $request->input('pid', 0);
        $cart = new Cart();
        $cart->setUserId(auth()->user()->id);
        return response()->json(['data'=> $cart->addProductFromCart((int)$pid)]);
    }
}
