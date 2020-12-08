<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Google_api;
use App\Http\Controllers\App_Controller;

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


Route::get('/', [Google_api::class, 'login']);
Route::get('/logout', [App_Controller::class, 'logout']);
Route::get('/g-response',[Google_api::class, 'user_data']);
Route::get('/home', function(){
    if (Session::has('account')){
        return view('home');
    }else{
        return redirect('');
    }
});
