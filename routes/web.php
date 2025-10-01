<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\FabricController;
use App\Http\Controllers\FabricStockController;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin/')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fabric Routes
    Route::get('fabrics/trash', [FabricController::class, 'trash'])->name('fabrics.trash');
    Route::get('fabrics/{fabric}/print-barcode', [FabricController::class, 'printBarcode'])->name('fabrics.print-barcode');
// Route::get('fabrics/{fabric}/stocks', [FabricController::class, 'showStocks'])->name('fabrics.stocks');
//     Route::get('fabrics/{fabric}/stocks/create', [FabricController::class, 'createStock'])->name('fabrics.stocks.create');
//     Route::post('fabrics/{fabric}/stocks', [FabricController::class, 'storeStock'])->name('fabrics.stocks.store');
    Route::post('fabrics/{id}/restore', [FabricController::class, 'restore'])->name('fabrics.restore');
    Route::delete('fabrics/{id}/force-delete', [FabricController::class, 'forceDelete'])->name('fabrics.force-delete');
    Route::resource('fabrics', FabricController::class);


        Route::resource('fabrics.stocks', FabricStockController::class)->except(['show', 'edit', 'update']);


    // Supplier Routes
    Route::get('suppliers/trash', [SupplierController::class, 'trash'])->name('suppliers.trash');
    Route::post('suppliers/{id}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore');
    Route::delete('suppliers/{id}/force-delete', [SupplierController::class, 'forceDelete'])->name('suppliers.force-delete');
    Route::resource('suppliers', SupplierController::class);

    // Notes Route
    Route::post('notes', [NoteController::class, 'store'])->name('notes.store');



});

require __DIR__.'/auth.php';
