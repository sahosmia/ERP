<?php

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierRepository
{
    public function getAll(Request $request)
    {
        $query = Supplier::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('company_name', 'like', "%{$searchTerm}%")
                  ->orWhere('country', 'like', "%{$searchTerm}%")
                  ->orWhere('representative_name', 'like', "%{$searchTerm}%");
        }

        if ($request->has('country')) {
            $query->where('country', $request->input('country'));
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')]);
        }

        return $query->paginate(10);
    }

    public function create(array $data)
    {
        return Supplier::create($data);
    }

    public function update(Supplier $supplier, array $data)
    {
        $supplier->update($data);
        return $supplier;
    }

    public function delete(Supplier $supplier)
    {
        $supplier->delete();
    }

    public function getTrashed()
    {
        return Supplier::onlyTrashed()->paginate(10);
    }

    public function findTrashed($id)
    {
        return Supplier::onlyTrashed()->findOrFail($id);
    }

    public function restore(Supplier $supplier)
    {
        $supplier->restore();
        return $supplier;
    }

    public function forceDelete(Supplier $supplier)
    {
        $supplier->forceDelete();
    }
}