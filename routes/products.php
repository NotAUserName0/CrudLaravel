<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('*', function () {
    return response(null,404);
});

Route::get('/show', [ProductController::class, "index"]);

Route::get('/showat/{nombre}', 'App\Http\Controllers\ProductController@show'); //show en especifico

Route::post('/add', 'App\Http\Controllers\ProductController@create');

Route::delete('/delete/{id}', 'App\Http\Controllers\ProductController@destroy');

Route::put('/update/{id}', 'App\Http\Controllers\ProductController@edit');
