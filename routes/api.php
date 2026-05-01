<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apicontroller;
use App\Http\Controllers\logincontroller;
use  App\Http\Controllers\usertokencontroller;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('user', [apicontroller::class, 'alluser']);

Route::get('user/{id}', [apicontroller::class, 'singleuser']);


Route::post('register', [usertokencontroller::class, 'register']);
