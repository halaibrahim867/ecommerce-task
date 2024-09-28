<?php

use App\Http\Controllers\AuthUser\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register',[AuthController::class,'register']);

Route::post('/login',[AuthController::class,'login']);


Route::group(['middleware'=>'auth:sanctum'],function (){


    Route::get('/products',[ProductController::class,'index']);

    Route::get('/product/{id}',[ProductController::class,'show']);

    Route::post('cart/add/{productId}', [CartController::class, 'addToCart']);
    Route::delete('cart/delete/{cartProduct}', [CartController::class, 'deleteCartItem']);
    Route::put('cart/{productId}/increment', [CartController::class, 'incrementCartItem']);
    Route::put('cart/{cartProduct}/decrement', [CartController::class, 'decrementCartItem']);

    Route::post('/order/create',[OrderController::class,'store']);
});
