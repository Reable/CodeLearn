<?php

namespace App\Http\Controllers;

use App\Models\ProgrammingLanguagesModel;
use Illuminate\Support\Facades\Request;

class AdminController extends Controller
{
    public function admin_panel_page(){
        return view('admin.admin_panel.administration');
    }

    public function add_languages_page(Request $request){
        $languages = ProgrammingLanguagesModel::all();

        $data = [
            'languages'=>$languages
        ];

        return view('admin.admin_panel.add.add_languages_programming',['data'=>$data]);
    }
}
