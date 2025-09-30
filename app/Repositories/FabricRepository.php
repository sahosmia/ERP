<?php

namespace App\Repositories;

use App\Models\Fabric;
use Illuminate\Support\Facades\Storage;

class FabricRepository
{
    public function getAll($request)
    {
        $query = Fabric::with('supplier')
            ->withSum(['stocks as stock_in' => fn($q) => $q->where('transaction_type', 'in')], 'qty')
            ->withSum(['stocks as stock_out' => fn($q) => $q->where('transaction_type', 'out')], 'qty');

        if ($request->filled('company_name')) {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('company_name', 'like', '%' . $request->input('company_name') . '%');
            });
        }

        if ($request->filled('fabric_no')) {
            $query->where('fabric_no', 'like', '%' . $request->input('fabric_no') . '%');
        }

        if ($request->filled('composition')) {
            $query->where('composition', 'like', '%' . $request->input('composition') . '%');
        }

        if ($request->filled('production_type')) {
            $query->where('production_type', $request->input('production_type'));
        }

        if ($request->filled('stock_status')) {
            $stockStatus = $request->input('stock_status');
            if ($stockStatus === 'in_stock') {
                $query->havingRaw('(COALESCE(stock_in, 0) - COALESCE(stock_out, 0)) > 0');
            } elseif ($stockStatus === 'out_of_stock') {
                $query->havingRaw('(COALESCE(stock_in, 0) - COALESCE(stock_out, 0)) <= 0');
            }
        }

        return $query->paginate(10);
    }

    public function create(array $data)
    {
        return Fabric::create($data);
    }

    public function update(Fabric $fabric, array $data)
    {
        $fabric->update($data);
        return $fabric;
    }

    public function delete(Fabric $fabric)
    {
        $fabric->delete();
    }

    public function getTrashed()
    {
        return Fabric::onlyTrashed()->with('supplier')->paginate(10);
    }

    public function findTrashed($id)
    {
        return Fabric::onlyTrashed()->findOrFail($id);
    }

    public function restore(Fabric $fabric)
    {
        $fabric->restore();
        return $fabric;
    }

    public function forceDelete(Fabric $fabric)
    {
        if ($fabric->image_path) {
            Storage::disk('public')->delete($fabric->image_path);
        }
        $fabric->forceDelete();
    }
}
