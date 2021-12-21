<?php

namespace App\Http\Controllers;

use App\Models\ProgrammingLanguagesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function admin_panel_page(){
        return view('admin.admin_panel.administration');
    }

    public function add_languages_page(Request $request){
        $languages = ProgrammingLanguagesModel::all();

        $data = [
            'lang'=>$languages
        ];

        return view('admin.admin_panel.add.add_languages_programming',['data'=>$data]);
    }

    public function add_languages(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'creator'=>'required|string',
            'year_creation'=>'required|date',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],422);
        }

        $language = new ProgrammingLanguagesModel();

        $language->name = $request->input('name');
        $language->creator = $request->input('creator');
        $language->year_creation = $request->input('year_creation');
        $language->save();

        $lang = ProgrammingLanguagesModel::all();

        return response()->json([
            'message'=>'Язык программирования добавлен',
            'languages'=>$lang,
        ],200);
    }
    public function delete_language(Request $request){
        $id = $request->input('language_id');
        $language = ProgrammingLanguagesModel::find($id);

        if($language === null) return;

        $language->delete();

        $lang = ProgrammingLanguagesModel::all();

        return response()->json([
            'message'=>'Язык успешно удален',
            'languages'=>$lang
        ],200);
    }
}
