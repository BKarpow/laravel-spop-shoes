<?php

namespace App\Http\Controllers;

use App\Models\NPInfo;
use App\Models\User;
use Illuminate\Http\Request;

class NPInfoController extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }

    function ajax_get_data(){
        return response()
            ->json([
                NPInfo::select('first_name',
                    'family_name',
                    'phone',
                    'city_string',
                    'delivery_string',
                    'city_ref')
                    ->where('user_id', auth()->user()->id)
                    ->get()
                    ->toArray()]);
    }

    function ajax_save_data(Request $request)
    {
        $user = User::find(auth()->user()->id)->npInfo;
//        dd($user);
//        $user->user_id = ;
        $user->first_name = $request->input('firstName', '');
        $user->family_name = $request->input('familyName', '');
        $user->phone = $request->input('phone', '');
        $user->city_string = $request->input('city', '');
        $user->city_ref = $request->input('cityRef', '');
        $user->delivery_string = $request->input('branch', '');
        $user->save();
    }
}
