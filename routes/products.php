<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('*', function () {
    return response(null,404);
});

Route::get('/show', [ProductController::class, "index"]);

Route::get('/showat/{nombre}', 'App\Http\Controllers\ProductController@show'); //show en especifico

Route::post('/add', 'App\Http\Controllers\ProductController@create');

Route::delete('/delete', function () {
    return "welcome products";
});

Route::put('/update', function () {
    return "welcome products";
});
