<?php

namespace App\Http\Controllers;

use App\Models\ChaptersModel;
use App\Models\ProgrammingLanguagesModel;
use App\Models\RecordingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearnController extends Controller
{
    //
    public function learning_page(Request $request){
        $language = $request->route('language');

        $allInfoByLanguage = DB::table('programming_languages')->where('name',$language)->first();
        $allInfoByChapters = ChaptersModel::where('language',$language)->get();
        $allInfoByRecordings = RecordingsModel::where('language',$language)->get();


        $data = [
            'language' => $allInfoByLanguage,
            'recordings'=>$allInfoByRecordings,
            'chapters'=>$allInfoByChapters
        ];
        return view('information_page_language',['data'=>$data]);
    }
}
