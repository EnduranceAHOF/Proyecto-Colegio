<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Google_api;
use App\Http\Controllers\App_Controller;
use App\Http\Controllers\View_System;

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
// Route::get('/admin', [App_Controller::class], 'admin');
Route::get('/change_period', [App_Controller::class, 'change_period']);
Route::get('/add_new_period', [App_Controller::class, 'add_new_period']);
Route::get('/logout', [App_Controller::class, 'logout']);
Route::get('/g-response',[Google_api::class, 'user_data']);
Route::get('/{param}',[View_System::class, 'main']);
