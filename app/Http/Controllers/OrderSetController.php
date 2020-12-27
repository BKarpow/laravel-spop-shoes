<?php

namespace App\Http\Controllers;

use App\Models\OrderSet;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;

class OrderSetController extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Рахкє сумму всіх товарів з масиву.
     * @param array $products_array
     * @return float
     */
    private function calcAllSum(array $products_array):float
    {
        $sum = 0.0;
        foreach ($products_array as $item) {
            $sum += (float) $item['price'];
        }
        return $sum;
    }

    function create(Request $request)
    {
        $status_id = OrderStatus::orderBy('id', 'ASC')->first();
        $user = User::find(auth()->user()->id);
        $order = new OrderSet();
        $validateData = $request->validate([
            'products' => 'required|array',
            'firstName' => 'required|max:200',
            'familyName' => 'required|max:200',
            'branch' => 'required',
            'city' => 'required|max:200',
            'cityRef' => 'required|max:200',
            'phone' => 'required|max:20',
            'cost' => 'required|max:5',
            'typeOfPayment' => 'required'
        ]);
        $address_set['branch'] = $request->branch;
        $address_set['city'] = $request->city;
        $address_set['cityRef'] = $request->cityRef;
        $order->status_id = $status_id->id;
        $order->user_id = auth()->user()->id;
        $order->products_set = json_encode($request->products);
        $order->address_set = json_encode($address_set);
        $order->payment = $request->typeOfPayment;
        $order->price_delivery = $request->cost;
        $order->price_product = $this->calcAllSum($request->products);
        $order->save();
        $user->cart()->delete();

        return response()->json(['ok'=>true, 'redirect' => '/order/success']);
    }

    function success(){
        return view('pages.order.success');
    }
}
