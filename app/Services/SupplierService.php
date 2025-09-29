<?php

namespace App\Services;

use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getSuppliers(Request $request)
    {
        return $this->supplierRepository->getAll($request);
    }

    public function createSupplier(array $data)
    {
        $data['added_by'] = Auth::id();
        return $this->supplierRepository->create($data);
    }

    public function updateSupplier($supplier, array $data)
    {
        $data['updated_by'] = Auth::id();
        return $this->supplierRepository->update($supplier, $data);
    }

    public function deleteSupplier($supplier)
    {
        $this->supplierRepository->delete($supplier);
    }

    public function getTrashedSuppliers()
    {
        return $this->supplierRepository->getTrashed();
    }

    public function restoreSupplier($id)
    {
        $supplier = $this->supplierRepository->findTrashed($id);
        return $this->supplierRepository->restore($supplier);
    }

    public function forceDeleteSupplier($id)
    {
        $supplier = $this->supplierRepository->findTrashed($id);
        $this->supplierRepository->forceDelete($supplier);
    }
}