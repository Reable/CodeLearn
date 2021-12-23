<?php

namespace App\Http\Controllers;

use App\Models\ChaptersModel;
use App\Models\ProgrammingLanguagesModel;
use App\Models\RecordingsModel;
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
    //Добавление записей
    public function add_recording_page(Request $request){
        $languages = ProgrammingLanguagesModel::all();
        $chapters = ChaptersModel::all();

        $data = [
            'language'=>$languages,
            'chapters'=>$chapters,
        ];
        return view('admin.admin_panel.add.create_recording',['data'=>$data]);
    }
    public function add_chapters_page(Request $request){
        $languages = ProgrammingLanguagesModel::all();

        $data = [
            'language'=>$languages
        ];

        return view('admin.admin_panel.add.add_chapters',['data'=>$data]);
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

    public function add_recording(Request $request){
        $validator = Validator::make($request->all(),[
            'title'=>'required|string',
            'language' => 'required',
            'image'=>'required|max:4096',
            'learning_text'=>'required'
        ]);

        if($validator->fails()){
            return redirect()->route('add_recording_page')
                ->withErrors($validator->errors(),'add_recording');
//            return response()->json([
//                'message'=>'Ошибка добавления',
//                'errors'=>$validator->errors()
//            ],422);
        }

        $allRecordings = RecordingsModel::where('language',$request->input('language'))->count();

        $imagename = "1_". rand() ."_". time() .".". $request->file("image")->extension();
        $request->file("image")->move(public_path("/image"), $imagename);
        $path = "/image/". $imagename;

        $recording = new RecordingsModel();
        $recording->record_number = $allRecordings + 1;
        $recording->language = $request->input('language');
        $recording->chapters = $request->input('chapters');
        $recording->title = $request->input('title');
        $recording->path_to_image = $path;
        $recording->learning_text = $request->input('learning_text');
        $recording->save();

        return redirect()->route('add_recording_page')
            ->withErrors('Запись успешно добавлена','message');

    }

    public function add_chapters(Request $request){
        $validator = Validator::make($request->all(),[
            'title'=>'required|string',
            'language' => 'required',
            'image'=>'required|max:4096'
        ]);

        if($validator->fails()){
            return redirect()->route('add_chapters_page')
                ->withErrors($validator->errors(),'add_chapters');
//            return response()->json([
//                'message'=>'Ошибка добавления',
//                'errors'=>$validator->errors()
//            ],422);
        }

        $allChapters = ChaptersModel::where('language',$request->input('language'))->count();

        $imagename = "1_". rand() ."_". time() .".". $request->file("image")->extension();
        $request->file("image")->move(public_path("/image"), $imagename);
        $path = "/image/". $imagename;

        $chapter = new ChaptersModel();
        $chapter->chapter_number = $allChapters + 1;
        $chapter->language = $request->input('language');
        $chapter->title = $request->input('title');
        $chapter->path_to_image = $path;
        $chapter->save();

        return redirect()->route('add_chapters_page')
            ->withErrors('Глава успешно добавлена','message');

    }
}
