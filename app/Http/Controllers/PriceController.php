<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceCreateRequest;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    function ajax_create_new(PriceCreateRequest $request){
        $Price = new Price();
        $res = $Price->addNewPrice(
            (float)$request->input('uan'),
            (float)$request->input('uan_min', 0.0),
        );
        return response()->json(['result' => $res]);
    }
}
