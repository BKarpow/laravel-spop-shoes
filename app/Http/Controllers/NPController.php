<?php

namespace App\Http\Controllers;

use App\Traits\NovaPoshtaAPI;
use Illuminate\Http\Request;

class NPController extends Controller
{
    use NovaPoshtaAPI;
    private string $token;
    private string $url;

    public function __construct(){
        $this->middleware('auth');
        $this->token = env('NOVA_POSHTA_API_KEY', '');
        $this->url = env('NOVA_POSHTA_API_URL', '');
    }


    function ajax_regions(){
        return response()->json(['data'=>$this->getRegions()]);
    }

    function ajax_city_from_area(Request $request)
    {
        return response()
            ->json([
                'data' => $this
                            ->getCity($request->input('search', ''))
            ]);
    }

    function ajax_get_branch(Request $request)
    {
        return response()
            ->json([
                'data' => $this
                    ->getBranch(
                        $request->input('cityRef', ''),
                        $request->input('cityName', '')
                    )
            ]);
    }

    function ajax_calc_cost(Request $request)
    {
        return response()
            ->json([
                'data' => $this
                    ->calculationCast(
                        $request->input('cityRef', ''),
                        (float)$request->input('weight', 0.5),
                    )
            ]);
    }

}
