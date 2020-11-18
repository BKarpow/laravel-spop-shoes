<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //ajax
    function ajax_get_likes(Request $request)
    {
        $id = (int) $request->input('pid');
        $uid = (int) auth()->user()->id;
        $Likes = new Like();
        $Likes->init($uid, $id);
        $data = $Likes->getInfo();
        return response()->json(['data'=>$data]);
    }

    function ajax_increment_like($product_id)
    {
        $id = (int) $product_id;
        $uid = (int) auth()->user()->id;
        $Likes = new Like();
        $Likes->init($uid, $id);
        $lk = $Likes->liker();
        return response()->json(['data'=>$lk]);

    }
}
