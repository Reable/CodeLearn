<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuchController extends Controller
{
    //Вывод страницы авторизации
    public function authorization_page(Request $request){

        return view('admin.authorization');
    }

    public function register_page(){
        return view('admin.register');
    }

    public function register(Request $request){
        $message = [
            'required'=>'Это поле должно быть заполненым',
            'max'=>'В поле должно содержаться от 4-х до 100 символов',
            'min'=>'Минимальное количество знаков 5',
            'string'=>'Это поле должно быть строкой'
        ];
        $validator = Validator::make($request->all(),[
            'login'=>'required|max:100|min:4|string',
            'name'=>'required|max:100|min:4|string',
            'surname'=>'required|max:100|min:4|string',
            'password'=>'required|max:100|min:5'
        ],$message);

        if($validator->fails()){
            return redirect()->route('register_page')->withErrors($validator,'register');
        }

        $user = new UsersModel();
        $user->login = $request->input('login');
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->password = bcrypt($request->input('password'));
        $user->role = 0;
        $user->save();
        return redirect()->route('authorization_page')->withErrors('Вы успешно зарегестрировались','message');
    }
    //
    public function authorization(Request $request){
        $message = [
            'required'=>'Это поле должно быть заполненым'
        ];
        $validator = Validator::make($request->all(),[
            'login'=>'required',
            'password'=>'required'
        ],$message);

        if($validator->fails()){
            return redirect()->route('authorization_page')->withErrors($validator,'authorization');
        }

        $login = $request->input('login');
        $password = $request->input('password');

        if(Auth::attempt(['login'=>$login,'password'=>$password],true)){
            return redirect()->route('index_page');
        }else{
            return redirect()->route('authorization_page')->withErrors('Ошибка логина или пароля','homeProblem');
        }
    }
    //
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('index_page')->withErrors('Вы вышли','message');
    }
}
