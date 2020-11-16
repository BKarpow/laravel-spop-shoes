<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    function create_new_page(){
        return view('admin.pages.api.create');
    }

    function create_new_page_action(Request $request){
        $Api = new ApiToken();
        $user_id = (int) auth()->user()->id;
        $token = $Api->createNewToken($user_id);
        if ($token === false){
            return  redirect()
                ->route('api.token.create')
                ->with('token', 'Кількисть максимально допустимих токенів перевищено!');
        }
        $Api->tokenToggle($token);
        return  redirect()->route('api.token.create')->with('token', $token);
    }

    //Ajax
    function ajax_get_all_from_user(){
        $Api = new ApiToken();
        $user_id = (int) auth()->user()->id;
        $all = $Api->getAllTokensFromUser($user_id);
        return response()->json(['data'=>$all]);
    }
    function ajax_active_token(Request $request)
    {
        $Api = new ApiToken();
        $token = $request->input('token', false);
        if ($token){
            $Api->tokenToggle($token);
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
    function ajax_delete_token(Request $request)
    {
        $Api = new ApiToken();
        $token = $request->input('token', false);
        if ($token){
            $Api->deleteToken($token);
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}
