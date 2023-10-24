<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoikusController;
use App\Http\Controllers\WorksController;
use App\Http\controllers\SearchController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//ログイン
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ログイン後
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 新規登録画面
// Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');

// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


//メインページ
Route::get('/main',[HoikusController::class, 'main'])->name('main');

//投稿作成ページ表示
Route::get('/create',[WorksController::class, 'create'])->name('create');

//投稿確認ページへセッション受け渡し
Route::post('/create',[WorksController::class,'create_post'])->name('create_post');

//投稿確認ページ表示
Route::get('/createConfirm',[WorksController::class, 'createConfirm'])->name('createConfirm');


//投稿完了ページ
Route::get('/creteComplete', [WorksController::class, 'createComplete'])->name('createComplete');
Route::post('/createComplete',[WorksController::class, 'complete_send'])->name('complete_send');

//検索ページ
Route::get('/search',[SearchController::class, 'search'])->name('search');
Route::post('/search',[SearchController::class, 'search'])->name('search');



//自身の投稿一覧
Route::get('/myIndex',[SearchController::class, 'myIndex'])->name('myIndex');

//全一覧
Route::get('/allIndex',[SearchController::class, 'allIndex'])->name('allIndex');

//キーワード検索一覧
Route::get('/searchIndex',[SearchController::class, 'searchIndex'])->name('searchIndex');
Route::post('/searchIndex',[SearchController::class, 'searchIndex']);

//削除機能
Route::delete('/works/{work}',[SearchController::class, 'destroy'])->name('works.destroy');

//編集機能
Route::get('/works/{work}/edit', [SearchController::class, 'edit'])->name('works.edit');
Route::put('/works/{work}', [SearchController::class, 'update'])->name('works.update');

//いいね機能
Route::post('/works/{work}/like', [SearchController::class ,'toggleLike'])->name('works.like');

// いいね数を取得するルート
Route::get('/works/{work}/likes', [SearchController::class, 'getLikesCount'])->name('works.likes');

//パスワードリセット
Route::get('/editPassword', [SearchController::class, 'editPassword'])->name('editPassword');
Route::put('/editPassword', [SearchController::class, 'updatePassword'])->name('updatePassword');