<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'studentRegister'])->name('studentRegister');

Route::get('/login', function () {
    return redirect('/');
});

Route::get('/',[AuthController::class,'loadlogin']);
Route::post('/login',[AuthController::class,'userLogin'])->name('userLogin');

Route::get('/logout',[AuthController::class,'logout']);

Route::get('/forget-password',[AuthController::class,'forgetpasswordLoad']);
Route::post('/forget-password',[AuthController::class,'forgetpassword'])->name('forgetPassword');


Route::group(['middleware'=>['web','checkAdmin']],function(){
    Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);

    //subjects
    Route::post('/add-subject',[AdminController::class,'addSubject'])->name('addSubject');
});

Route::group(['middleware'=>['web','checkStudent']],function(){
    Route::get('/dashboard',[AuthController::class,'loadDashboard']);
});






