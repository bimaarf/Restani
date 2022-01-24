<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChattingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscribeController;
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
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/shop/tag', [ProductController::class, 'tag'])->name('shop.tag'); //index

Route::get('/shop', [ProductController::class, 'shop'])->name('shop.product'); //index
Route::get('/shop/elements', [ProductController::class, 'shopElement'])->name('shop.elements.product'); //elements
Route::get('/shop/v/{slug}', [ProductController::class, 'preview'])->name('shop.preview');
Route::post('/product/store', [ProductController::class, 'store'])->name('shop.store')->middleware('auth');

Route::get('/cart/count', [CartController::class, 'sum'])->name('shop.elements.countCart'); //cart count
Route::get('/cart/elements', [CartController::class, 'cartElements'])->name('shop.elements.cart'); //ajax

Route::get('/cart', [CartController::class, 'cart'])->name('shop.cart'); //index
Route::get('/cart/delete/{id}', [CartController::class, 'cartDelete'])->name('shop.elements.cartDelete'); //delete
Route::get('/cart/add/{id}', [CartController::class, 'addCart'])->name('shop.addCart'); // add
Route::get('/cart/update/{id}', [CartController::class, 'updateCart'])->name('shop.updateCart'); // update

// booking

Route::get('/booking', [BookingController::class, 'booking'])->name('shop.booking'); //index
Route::get('/booking/elements', [BookingController::class, 'bookElement'])->name('shop.elements.booking'); //elements
Route::get('/booking/add/{id}', [BookingController::class, 'addBook'])->name('shop.addBook');  // add
Route::get('/booking/delete/{id}', [BookingController::class, 'deleteBook'])->name('shop.elements.bookDelete'); //delete
Route::get('/booking/update/{id}', [BookingController::class, 'updateBook'])->name('shop.updateBook'); // update

// subscribve
Route::get('/subscribe', [SubscribeController::class, 'sub'])->name('shop.subscribe'); //index
Route::get('/subscribe/elements', [SubscribeController::class, 'subElement'])->name('shop.elements.subscribe'); //elements
Route::get('/subscribe/add/{id}', [SubscribeController::class, 'addSub'])->name('shop.addSub');  // add
Route::get('/subscribe/delete/{id}', [SubscribeController::class, 'deleteSub'])->name('shop.elements.subDelete'); //delete
Route::get('/subscribe/update/{id}', [SubscribeController::class, 'updateSub'])->name('shop.updateSub'); // update

// chatting

Route::get('/chatting', [ChattingController::class, 'index'])->name('chats.index'); //index
Route::get('/chatting/box/{id}', [ChattingController::class, 'box'])->name('chats.elements.box'); //index
Route::get('/chatting/store', [ChattingController::class, 'store'])->name('chats.store');  // add

// room
Route::get('/room/add/', [ChattingController::class, 'addRoom'])->name('chats.addRomm');  // add

Route::get('/room/count', [ChattingController::class, 'sum'])->name('chats.elements.countChat'); //chat count