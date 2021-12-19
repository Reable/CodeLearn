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
//Главная страница
Route::get('/',[IndexController::class,'index_page'])->name('index_page');
//Страница авторизации
Route::post('/register',[AuchController::class,'register'])->name('register');
Route::get('/register',[AuchController::class,'register_page'])->name('register_page');

Route::post('/auth',[AuchController::class,'authorization'])->name('authorization');
Route::get('/auth',[AuchController::class,'authorization_page'])->name('authorization_page');

Route::get('/personal_area',[PersonalAreaController::class,'personalArea'])->name('personal_area');
Route::get('/personal_area/update',[PersonalAreaController::class,'update_profile_input'])->name('update_profile_input');
Route::post('/personal_area/update/test',[PersonalAreaController::class,'update_profile'])->name('update_profile');

Route::get('/logout',[AuchController::class,'logout'])->name('logout');
