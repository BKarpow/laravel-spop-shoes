<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class SitemapController extends Controller
{

    function index()
    {
        $p = Product::orderBy('updated_at', 'desc')->first();
        $c = ProductCategory::orderBy('updated_at', 'desc')->first();
        return response()
            ->view('sitemap.index', [
                'products' => $p,
                'category' => $c,
                ])->header('Content-Type', 'text/xml');
    }

    function products()
    {
        $p = Product::orderBy('updated_at', 'desc')->get();
        return response()
            ->view('sitemap.product', ['products' => $p])
            ->header('Content-Type', 'text/xml');
    }


    function category()
    {
        $c = ProductCategory::orderBy('updated_at', 'desc')->get();
        return response()
            ->view('sitemap.category', ['categories' => $c])
            ->header('Content-Type', 'text/xml');
    }
}
