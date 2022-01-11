<?php

use App\Http\Controllers\ProductController;
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


Route::get('shop', [ProductController::class, 'shop'])->name('shop.product');
Route::get('shop/v/{slug}', [ProductController::class, 'preview'])->name('shop.preview');
Route::post('product/store', [ProductController::class, 'store'])->name('shop.store')->middleware('auth');
require __DIR__.'/auth.php';
