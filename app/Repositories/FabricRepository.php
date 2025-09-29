<?php

namespace App\Repositories;

use App\Models\Fabric;
use Illuminate\Support\Facades\Storage;

class FabricRepository
{
    public function getAll()
    {
        return Fabric::with('supplier')->paginate(10);
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
