<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Налаштування головної сторінки магазину
     */
    // TODO Настройка головної сторінки
    function main_page(){
        return view('index');
    }
}
