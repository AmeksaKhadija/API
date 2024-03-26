<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompteController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();


});

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->get('compte', [CompteController::class, 'show']);
// Route::get('compte', [CompteController::class, 'show']);
Route::post('compte/send-money', [CompteController::class, 'sendMoney'])->middleware('auth:sanctum');
Route::get('compte/transactions', [CompteController::class, 'transactionHistory'])->middleware('auth:sanctum');

