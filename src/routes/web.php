<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\WishListResourceController;

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

// WishList一覧画面を表示
Route::get('/', 'App\Http\Controllers\WishListController@showList')->name('wishlists');

// WishList登録
Route::resource('/wishlist', WishListResourceController::class);

// WishList登録画面を表示
Route::get('/wishlist/create', 'App\Http\Controllers\WishListController@showCreate')->name('create');

// WishList詳細画面を表示
Route::get('/wishlist/{id}', 'App\Http\Controllers\WishListController@showDetail')->name('show');

