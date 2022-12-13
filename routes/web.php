<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
 //   return view('');
//});

Route::get('main',[AuthController::class,'index']);
Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('loginUser',[AuthController::class,'loginUser'])->name('loginUser');
Route::get('registration',[AuthController::class,'registration']);
Route::post('validate_registration',[AuthController::class,'validate_registration'])->name('validate_registration');
Route::get('logout',[AuthController::class,'logout']);
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
// Route::get('hello',[TestController::class,'index'])->middleware('auth');
