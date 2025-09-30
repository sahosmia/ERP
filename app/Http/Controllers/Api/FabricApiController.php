<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FabricResource;
use App\Models\Fabric;
use App\Http\Requests\StoreFabricRequest;
use App\Http\Requests\UpdateFabricRequest;
use Illuminate\Http\Request;
use App\Services\FabricService;

class FabricApiController extends Controller
{
    protected $fabricService;

    public function __construct(FabricService $fabricService)
    {
        $this->fabricService = $fabricService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Fabric::with('supplier');

        if ($request->filled('fabric_no')) {
            $query->where('fabric_no', 'like', '%' . $request->input('fabric_no') . '%');
        }

        if ($request->filled('composition')) {
            $query->where('composition', 'like', '%' . $request->input('composition') . '%');
        }

        if ($request->filled('production_type')) {
            $query->where('production_type', $request->input('production_type'));
        }

        if ($request->filled('company_name')) {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('company_name', 'like', '%' . $request->input('company_name') . '%');
            });
        }

        return FabricResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFabricRequest $request)
    {
        $fabric = $this->fabricService->createFabric($request->validated(), $request->file('image'));
        return new FabricResource($fabric);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fabric $fabric)
    {
        return new FabricResource($fabric);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFabricRequest $request, Fabric $fabric)
    {
        $fabric = $this->fabricService->updateFabric($fabric, $request->validated(), $request->file('image'));
        return new FabricResource($fabric);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fabric $fabric)
    {
        $fabric->delete();
        return response()->noContent();
    }
}