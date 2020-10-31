<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    //Контроллер головної сторінки адмін панелі
    /**
     * Метод відображення головної сторінки адмін панелі
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function main_page()
    {
        return view('admin.index');
    }
}
