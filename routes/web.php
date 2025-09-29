<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\FabricController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('suppliers', SupplierController::class);
Route::resource('fabrics', FabricController::class);
