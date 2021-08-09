<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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


Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){
    Auth::routes();

});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin','middleware'=>['is_admin','auth','PreventBackHistory']],function(){
    Route::get('dashboard',[TaskController::class,'admin'])->name('admin.dashboard');
    Route::get('userlist',[TaskController::class,'userlist'])->name('admin.userlist');
    
});
// Route::group(['prefix'=>'user','middleware'=>['is_user','auth','PreventBackHistory']],function(){
//     Route::resource('tasks',TaskController::class);
    
// });

Route::resource('tasks',TaskController::class)->middleware(['is_user','auth','PreventBackHistory']);

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [TaskController::class,'index'])->name('home');
// Route::group(['prefix'=>'admin','middleware'=>'is_admin'],function(){
//     Route::get('/admin', [TaskController::class,'admin'])->name('admin');
// });

// Route::resource('tasks',TaskController::class);