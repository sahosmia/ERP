<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\FabricController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fabric Routes
    Route::get('fabrics/trash', [FabricController::class, 'trash'])->name('fabrics.trash');
    Route::get('fabrics/{fabric}/print-barcode', [FabricController::class, 'printBarcode'])->name('fabrics.print-barcode');
    Route::post('fabrics/{id}/restore', [FabricController::class, 'restore'])->name('fabrics.restore');
    Route::delete('fabrics/{id}/force-delete', [FabricController::class, 'forceDelete'])->name('fabrics.force-delete');
    Route::resource('fabrics', FabricController::class);

    // Supplier Routes
    Route::get('suppliers/trash', [SupplierController::class, 'trash'])->name('suppliers.trash');
    Route::post('suppliers/{id}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore');
    Route::delete('suppliers/{id}/force-delete', [SupplierController::class, 'forceDelete'])->name('suppliers.force-delete');
    Route::resource('suppliers', SupplierController::class);
});

require __DIR__.'/auth.php';
