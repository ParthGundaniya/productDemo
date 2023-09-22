<?php

use Illuminate\Support\Facades\Route;

Route::group( [ 'prefix' => 'v1'], function () {
    Route::resource('/products', App\Http\Controllers\Api\V1\ProductController::class);
});