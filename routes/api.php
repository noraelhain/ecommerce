<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\Auth\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login',[AuthController::class,'login']);

Route::post('/register',[AuthController::class,'register']);

Route::get('/categories',[CategoryController::class,'index']);
Route::get('/categories/{id}',[CategoryController::class,'show']);

Route::middleware('auth:sanctum')->post('logout',[AuthController::class,'logOut']);

Route::middleware('auth:sanctum')->post('logout-all',[AuthController::class,'logOutAll']);

Route::middleware('auth:sanctum')->delete('delete-account',[AuthController::class,'deleteAccount']);

Route::middleware('auth:sanctum')->post('update-account',[AuthController::class,'update']);
