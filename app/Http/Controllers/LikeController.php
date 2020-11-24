<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }

    //ajax
    function ajax_get_likes_debug()
    {
        $id = (int) 1;
        $uid = (int) auth()->user()->id;
        $Likes = new Like();
        $Likes->init($uid, $id);
        $data = $Likes->getInfo();
        $data = (!$data) ? [] : $data->toArray();
        $data['isLike'] = $Likes->isLiked();
        dd($data);
        return response()->json(['data'=>$data]);
    }


    function ajax_get_likes(Request $request)
    {
        $id = (int) $request->input('pid');

        $uid = (auth()->check()) ?(int) auth()->user()->id : 0 ;
        $Likes = new Like();
        $Likes->init($uid, $id);
        $data = $Likes->getInfo();
        $data = (!$data) ? [] : $data->toArray();
        $data['isLike'] = $Likes->isLiked();
        return response()->json(['data'=>$data]);
    }

    function ajax_increment_like(Request  $request)
    {
        $id = (int) $request->input('pid');  // Product id
        $uid = (int) auth()->user()->id; // User id
        $Likes = new Like();
        $Likes->init($uid, $id);
        $lk = $Likes->liker();
        return response()->json(['data'=>$lk]);

    }


    function ajax_decrement_like(Request $request)
    {
        $id = (int) $request->input('pid');  // Product id
        $uid = (int) auth()->user()->id; // User id
        $Likes = new Like();
        $Likes->init($uid, $id);
       // $Likes->like_minus();
        return response()->json(['data'=>$Likes->like_minus()]);
    }


    function ajax_get_like_products()
    {
        $id = (int) 0;  // Product id
        $uid = (int) auth()->user()->id; // User id
        $Likes = new Like();
        $Likes->init($uid, $id);
//        dd($Likes->getLikeProducts());
        return response()->json(['data'=>$Likes->getLikeProducts()]);
    }


    //Pages
    function page_likes()
    {
        $id = (int) 0;  // Product id
        $uid = (int) auth()->user()->id; // User id
        $Likes = new Like();
        $Likes->init($uid, $id);
//        dd($Likes->getLikeProducts());
        return view('pages.likes.index', ['data'=>$Likes->getLikeProducts()]);
    }
}
