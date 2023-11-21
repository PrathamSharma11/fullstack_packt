<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//api-data_insertion
Route::get('/store-data',[ProductController::class,'store']);

//Product controller
Route::get('/product/display',[ProductController::class,'display']);
Route::post('/save',[ProductController::class,'save']);
Route::get('/product/view/{id}',[ProductController::class,'view']);
Route::put('/product/update/{id}',[ProductController::class,'update']);
Route::delete('/product/delete/{id}',[ProductController::class,'destroy']);
Route::get('/product/details/{id}',[ProductController::class,'view']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');  //products?search=floyd

