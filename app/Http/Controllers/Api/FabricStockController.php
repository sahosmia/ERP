<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fabric;
use App\Models\FabricStock;
use App\Http\Resources\FabricStockResource;
use App\Http\Requests\StoreFabricStockRequest;

class FabricStockController extends Controller
{
    public function index(Fabric $fabric)
    {
        $stocks = $fabric->stocks()->paginate(10);
        return FabricStockResource::collection($stocks);
    }

    public function store(StoreFabricStockRequest $request, Fabric $fabric)
    {
        $stock = $fabric->stocks()->create($request->validated());
        return new FabricStockResource($stock);
    }

    public function destroy(Fabric $fabric, FabricStock $stock)
    {
        $stock->delete();
        return response()->noContent();
    }
}
