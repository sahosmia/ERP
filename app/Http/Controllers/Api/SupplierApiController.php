<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Http\Request;
use App\Services\SupplierService;

class SupplierApiController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $suppliers = $this->supplierService->getSuppliers($request);
        return SupplierResource::collection($suppliers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = $this->supplierService->createSupplier($request->validated());
        return new SupplierResource($supplier);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = $this->supplierService->getSupplierById($id);
        return new SupplierResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $updatedSupplier = $this->supplierService->updateSupplier($supplier, $request->validated());
        return new SupplierResource($updatedSupplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $this->supplierService->deleteSupplier($supplier);
        return response()->noContent();
    }
}