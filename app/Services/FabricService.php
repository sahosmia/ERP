<?php

namespace App\Services;

use App\Models\Fabric;
use App\Repositories\FabricRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FabricService
{
    protected $fabricRepository;

    public function __construct(FabricRepository $fabricRepository)
    {
        $this->fabricRepository = $fabricRepository;
    }

    public function getAllFabrics()
    {
        return $this->fabricRepository->getAll();
    }

    public function createFabric(array $data, $imageFile = null)
    {
        $data['added_by'] = Auth::id();
        $data['barcode'] = 'fab-' . Str::uuid();

        if ($imageFile) {
            $path = $imageFile->store('fabric_images', 'public');
            $data['image_path'] = $path;
        }

        return $this->fabricRepository->create($data);
    }

    public function updateFabric(Fabric $fabric, array $data, $imageFile = null)
    {
        $data['updated_by'] = Auth::id();

        if ($imageFile) {
            if ($fabric->image_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($fabric->image_path);
            }
            $path = $imageFile->store('fabric_images', 'public');
            $data['image_path'] = $path;
        }

        return $this->fabricRepository->update($fabric, $data);
    }

    public function deleteFabric(Fabric $fabric)
    {
        $this->fabricRepository->delete($fabric);
    }

    public function getTrashedFabrics()
    {
        return $this->fabricRepository->getTrashed();
    }

    public function restoreFabric($id)
    {
        $fabric = $this->fabricRepository->findTrashed($id);
        return $this->fabricRepository->restore($fabric);
    }

    public function forceDeleteFabric($id)
    {
        $fabric = $this->fabricRepository->findTrashed($id);
        $this->fabricRepository->forceDelete($fabric);
    }
}