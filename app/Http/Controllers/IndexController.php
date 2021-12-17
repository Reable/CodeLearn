<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //Вывод главной страницы
    public function index_page(Request $request){

        return view('index');
    }
}
