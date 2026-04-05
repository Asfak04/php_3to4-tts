<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController\ClickUser;
use App\Http\Controllers\UserController\Products;

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

Route::get('/',[ClickUser::class,'index']);
Route::get('/product',[Products::class,'index']);
Route::get('/product-details',[Products::class,'PoductsDetails']);
Route::get('/cart',[Products::class,'cart']);
Route::get('/orders',[Products::class,'orders']);
Route::get('/about',[ClickUser::class,'about']);
Route::get('/career',[ClickUser::class,'career']);
Route::get('/blogs',[ClickUser::class,'blogs']);
Route::get('/faq',[ClickUser::class,'faq']);
Route::get('/terms',[ClickUser::class,'terms']);
Route::get('/privacy',[ClickUser::class,'privacy']);
Route::get('/404',[ClickUser::class,'error404']);








