<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    function upload_image(Request $request){
        $path = 'local/images/users/'.auth()->user()->id.'/';
        $file = $request->file('image');
        if ($file){
            return response()->json(['ok'=>true,'path' => '/storage/app/'.$file->store($path)]);
        }
        return response()->json(['ok'=>false, 'path'=>'']);
    }
}
