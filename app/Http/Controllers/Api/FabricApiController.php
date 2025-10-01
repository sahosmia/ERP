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
        $fabrics = $this->fabricService->getAllFabrics($request);
        return FabricResource::collection($fabrics);
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
        $this->fabricService->deleteFabric($fabric);
        return response()->noContent();
    }
}