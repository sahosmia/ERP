<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FabricApiController;
use App\Http\Controllers\Api\FabricStockController;
use App\Http\Controllers\Api\SupplierApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->group(function () {
    //
    Route::apiResource('suppliers', SupplierApiController::class);
    Route::apiResource('fabrics', FabricApiController::class);
        Route::apiResource('fabrics.stocks', FabricStockController::class)->only(['index', 'store', 'destroy']);


});
