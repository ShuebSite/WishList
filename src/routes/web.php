<?php

use Illuminate\Http\Request;
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
Route::get('/', [WishListResourceController::class, 'index'])->name('wishlists');

// // WishList登録、編集、削除
Route::resource('/wishlist', WishListResourceController::class);
