<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FullOrderController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }


    function save_orders(Request $requests)
    {
        $order = User::find(auth()->user()->id)->order;
        $npInfo = User::find(auth()->user()->id)->npInfo;
        $order->np_id = (int) $npInfo->id;
        $order->cost = $requests->input('cost', 0);
        $order->dev_cost = $requests->input('cost', 0);
    }
}
