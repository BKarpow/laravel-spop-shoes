<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //Ajax
    function ajax_create_order(CreateOrderRequest $request){
        $Order = new Order();
        $product_id = $request->input('product_id', false);
        if ($product_id){
            if (auth()->check()){
                // Add number phone from register user
                if (!auth()->user()->userContact){
                    auth()->user()->userContact()->create([
                        'phone' => $request->input('phone')
                    ]);
                }
            }
            $order_id = $Order->addNewOrder(
                (int) $product_id,
                $request->input('phone'),
                $request->input('user_name', ''),
                $request->input('user_email', ''),
                $request->ip()
//                $request->input('user_comment', ''),
            );
            return response()->json(['order'=>true,'id'=>$order_id]);
        }else{
            abort(401);
        }
    }


    function ajax_get_all_new(){
        $Order = new Order();
        return response()->json(['data' => $Order->getAllNewOrder()]);
    }

    function show_order($order_id){
        $Order = new Order();
        return view('admin.pages.order.show', ['data' => $Order->getOrder((int) $order_id)]);
    }


}
