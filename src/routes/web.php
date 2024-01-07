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

// S3テスト画面を表示
Route::get('/wishlist/s3', [WishListResourceController::class, 'index_S3'])->name('wishlists_s3');

// S3 upload
Route::post('/upload', [WishListResourceController::class, 'upload'])->name('upload');

// S3 delete
Route::delete('/delete', [WishListResourceController::class, 'deleteS3Directory'])->name('delete');

// // WishList登録、編集、削除
Route::resource('/wishlist', WishListResourceController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
