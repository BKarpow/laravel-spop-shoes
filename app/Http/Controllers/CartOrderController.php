<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartProductResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartOrderController extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }

    function index(){
        $cart = new Cart();
        $cart->setUserId((int)auth()->user()->id);

        $data = auth()
            ->user()
            ->cart
            ->products()
            ->orderBy('created_at', 'desc')

            ->paginate(env('PER_PAGE', 15));
//        dd($data->toArray());
        return view('pages.order.delivery', ['data' => $data]);
    }

    function ajax_all_products(){
        $data = auth()
            ->user()
            ->cart
            ->products()
            ->orderBy('created_at', 'desc')
            ->all();
        return new CartProductResource($data);
    }
}
