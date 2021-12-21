<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuchController;
use App\Http\Controllers\PersonalAreaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register wb routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//(En)Home page (Ru)Главная страница
Route::get('/',[IndexController::class,'index_page'])->name('index_page');
//(En)Check if the user is authorized, then on these routes he cannot  (Ru)Если пользователь авторизован то на эти маршруты ему нельзя
Route::group(['middleware'=>'ifAuth'],function(){
//(En)Registration page  (Ru)Страница регистрации
    Route::post('/register',[AuchController::class,'register'])->name('register');
    Route::get('/register',[AuchController::class,'register_page'])->name('register_page');
//(En)Authentication page  (Ru)Страница аутентификации
    Route::post('/auth',[AuchController::class,'authorization'])->name('authorization');
    Route::get('/auth',[AuchController::class,'authorization_page'])->name('authorization_page');

});
//(En)Routes for authorized users  (Ru)Маршруты для авторизованных пользователей
Route::group(['middleware'=>'auth'],function(){
//    (En)Personal account page   (Ru)Страница личного кабинета
    Route::get('/personal_area',[PersonalAreaController::class,'personalArea'])->name('personal_area');
//    (En)Personal data change form  (Ru)Форма изменения личных данных
    Route::get('/personal_area/update',[PersonalAreaController::class,'update_profile_input'])->name('update_profile_input');
    Route::post('/personal_area/update/test',[PersonalAreaController::class,'update_profile'])->name('update_profile');

    //(En)Routes for administrators  (Ru)Маршруты для администраторов
    Route::group(['middleware'=>'administration'],function(){
        Route::get('/admin_panel',[AdminController::class,'admin_panel_page'])->name('admin_panel_page');
        //Добавление языка
        Route::get('/admin_panel/add_languages',[AdminController::class,'add_languages_page'])->name('add_languages_page');
        Route::post('/admin_panel/add_languages',[AdminController::class,'add_languages'])->name('add_languages');
        Route::get('/admin_panel/delete_language',[AdminController::class,'delete_language'])->name('delete_language');
    });
});


Route::get('/logout',[AuchController::class,'logout'])->name('logout');
