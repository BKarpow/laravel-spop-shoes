<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\TextToolTrait;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use TextToolTrait;

    function ajax_search(Request $request)
    {
        $p = new Product();
        $q = $request->input('q', '');
        $q = $this->scoped_string($q);
        return response()->json( $p->search($q)->toArray());
    }

    function page_search_result(Request $request){
        $p = new Product();
        $q = $request->input('q', '');
        $q = $this->scoped_string($q);
        return view('pages.search', ['data'=>$p->search($q), 'word' =>$q]);
    }
}
