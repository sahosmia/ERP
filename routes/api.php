<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FabricApiController;
use App\Http\Controllers\Api\SupplierApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('suppliers', SupplierApiController::class);
Route::apiResource('fabrics', FabricApiController::class);