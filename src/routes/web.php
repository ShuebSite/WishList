<?php

use Illuminate\Support\Facades\Route;

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

// WishList詳細画面を表示
Route::get('/wishlist/{id}', 'App\Http\Controllers\WishListController@showDetail')->name('show');
