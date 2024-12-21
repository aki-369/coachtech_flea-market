<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;

// トップページ
Route::get('/', [ItemController::class, 'index'])->name('top');

// 認証関連
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 商品関連
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.detail');
Route::get('/sell', [ItemController::class, 'showSellForm'])->name('sell');
Route::post('/sell', [ItemController::class, 'store']);
Route::post('/item/{item_id}/comment', [ItemController::class, 'addComment']);
Route::delete('/item/{item_id}/comment/{comment_id}', [ItemController::class, 'deleteComment']);

// お気に入り関連
Route::post('/item/{item_id}/favorite', [FavoriteController::class, 'store']);
Route::delete('/item/{item_id}/favorite', [FavoriteController::class, 'destroy']);

// 購入関連
Route::get('/purchase/{item_id}', [PurchaseController::class, 'showPurchaseForm']);
Route::post('/purchase/{item_id}', [PurchaseController::class, 'store']);
Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'showAddressForm']);
Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress']);

// マイページ関連
Route::get('/mypage', [UserController::class, 'showMypage'])->name('mypage');
Route::get('/mypage/profile', [UserController::class, 'editProfile']);
Route::post('/mypage/profile', [UserController::class, 'updateProfile']);

// 商品検索
Route::get('/item/search', [ItemController::class, 'search'])->name('search'); 
