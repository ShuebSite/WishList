<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\WishListResourceController;
use App\Http\Controllers\HomeController;

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

// ホーム（ログイン判別）画面を表示
Route::get('/', [HomeController::class, 'index'])->name('wishlists');

// S3テスト画面を表示
Route::get('/wishlist/s3', [WishListResourceController::class, 'index_S3'])->name('wishlists_s3');

// S3 upload
Route::post('/upload', [WishListResourceController::class, 'upload'])->name('upload');

// S3 delete
Route::delete('/delete', [WishListResourceController::class, 'deleteS3Directory'])->name('delete');

// // WishList登録、編集、削除
Route::resource('/wishlist', WishListResourceController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
