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


Route::middleware('auth:sanctum')->group(function(){
    Route::post('/categories/create',[CategoryController::class,'store']);
    Route::post('categories/update/{id}',[CategoryController::class,'updateCategory']);
    Route::delete('categories/delete/{id}',[CategoryController::class,'destroy']);
    Route::post('categories/{category}/toggle-active',[CategoryController::class,'toggleActive']);
});

Route::get('/categories/search/{keyword}',[CategoryController::class,'search']);
Route::get('/categories/{userId}',[CategoryController::class,'userCategories']);
