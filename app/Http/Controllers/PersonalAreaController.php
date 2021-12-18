<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalAreaController extends Controller
{
    //
    public function personalArea(Request $request){
        $id = Auth::id();

        $user = UsersModel::find($id);

        $data = [
            'user'=>$user
        ];

        return view('personalarea.personalArea',['data'=>$data]);
    }

}
