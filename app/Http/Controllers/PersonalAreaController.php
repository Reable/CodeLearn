<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PersonalAreaController extends Controller
{
    //
    public function personalArea(Request $request){
        $user = Auth::user();

        $data = [
            'user'=>$user
        ];

        return view('personalarea.personalArea',['data'=>$data]);
    }

    public function update_profile_input(Request $request){
        $user = Auth::user();

        return response()->json([
            'user'=>$user
        ],200);
    }

    public function update_profile(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string',
            'surname'=>'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],422);
        }


        $id = Auth::id();

        $user = UsersModel::find($id);

//        $user->path_to_image = $path;
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->save();

        $infoUser = UsersModel::where('id',$id)->first();
        return response()->json([
            'user'=>$infoUser
        ],200);
    }

}
