<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Services\SupplierService;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index(Request $request)
    {
        $suppliers = $this->supplierService->getSuppliers($request);

        if ($request->expectsJson()) {
            $suppliers->withPath(route('api.suppliers.index'));

            return response()->json([
                'data' => $suppliers->items(),
                'links_html' => $suppliers->links()->toHtml(),
            ]);
        }

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        $this->supplierService->createSupplier($request->validated());
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $this->supplierService->updateSupplier($supplier, $request->validated());
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(Supplier $supplier)
    {
        $this->supplierService->deleteSupplier($supplier);
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier moved to trash successfully.');
    }

    public function trash()
    {
        $trashedSuppliers = $this->supplierService->getTrashedSuppliers();
        return view('suppliers.trash', compact('trashedSuppliers'));
    }

    public function restore($id)
    {
        $this->supplierService->restoreSupplier($id);
        return redirect()->route('admin.suppliers.trash')->with('success', 'Supplier restored successfully.');
    }

    public function forceDelete($id)
    {
        $this->supplierService->forceDeleteSupplier($id);
        return redirect()->route('admin.suppliers.trash')->with('success', 'Supplier permanently deleted.');
    }
}