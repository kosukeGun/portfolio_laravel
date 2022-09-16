<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(["middleware" => "auth"], function() // ログインした状態でしか実行出来ない部分を括る
{
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home/noanswer', [App\Http\Controllers\HomeController::class, 'index2'])->name('index2');
    Route::get('/tagList', [App\Http\Controllers\HomeController::class, 'tag'])->name('tag');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
    // Route::get('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
    Route::get('/upload', [App\Http\Controllers\HomeController::class, 'upload'])->name('upload');
    // Routeを使う事でURLとコントローラのアクションの対応付けを行うことが出来る
    // URLでアクセスされたときには「このコントローラのアクションを呼び起こせ！！」とアプリに命令
    // メソッドとしてはget post put delete等がある
    // 第一引数：そのURL（{}内についてはアクションの引数に対応→関数の引数として定義）
    // 第二引数：コントローラが定義されたファイルのパスと関数名を格納したリスト
    // {}でくくった変数をコントローラのファイルにおける関数の引数に対応させて制御する
    // 
    


});



