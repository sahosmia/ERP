<?php

namespace App\Http\Controllers;

use App\Models\Fabric;
use App\Models\Supplier;
use App\Http\Requests\StoreFabricRequest;
use App\Http\Requests\StoreFabricStockRequest;
use App\Http\Requests\UpdateFabricRequest;
use App\Services\FabricService;
use Illuminate\Http\Request;

class FabricController extends Controller
{
    protected $fabricService;

    public function __construct(FabricService $fabricService)
    {
        $this->fabricService = $fabricService;
    }

    public function index(Request $request)
    {
        // The view now handles data fetching via an API call,
        // so we just need to return the blade shell.
        return view('fabrics.index');
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('fabrics.create', compact('suppliers'));
    }

    public function store(StoreFabricRequest $request)
    {
        $this->fabricService->createFabric($request->validated(), $request->file('image'));
        return redirect()->route('admin.fabrics.index')->with('success', 'Fabric created successfully.');
    }

    public function show(Fabric $fabric)
    {
        return view('fabrics.show', compact('fabric'));
    }

    public function edit(Fabric $fabric)
    {
        $suppliers = Supplier::all();
        return view('fabrics.edit', compact('fabric', 'suppliers'));
    }

    public function update(UpdateFabricRequest $request, Fabric $fabric)
    {
        $this->fabricService->updateFabric($fabric, $request->validated(), $request->file('image'));
        return redirect()->route('admin.fabrics.index')->with('success', 'Fabric updated successfully.');
    }

    public function destroy(Fabric $fabric)
    {
        $this->fabricService->deleteFabric($fabric);
        return redirect()->route('admin.fabrics.index')->with('success', 'Fabric moved to trash successfully.');
    }

    public function trash()
    {
        $trashedFabrics = $this->fabricService->getTrashedFabrics();
        return view('fabrics.trash', compact('trashedFabrics'));
    }

    public function restore($id)
    {
        $this->fabricService->restoreFabric($id);
        return redirect()->route('admin.fabrics.trash')->with('success', 'Fabric restored successfully.');
    }

    public function forceDelete($id)
    {
        $this->fabricService->forceDeleteFabric($id);
        return redirect()->route('admin.fabrics.trash')->with('success', 'Fabric permanently deleted.');
    }

    public function printBarcode(Fabric $fabric)
    {
        return view('fabrics.print', compact('fabric'));
    }




    // public function showStocks(Fabric $fabric)
    // {
    //     $stocks = $fabric->stocks()->paginate(10);
    //     return view('fabric-stocks.index', compact('fabric', 'stocks'));
    // }

    // public function createStock(Fabric $fabric)
    // {
    //     return view('fabric-stocks.create', compact('fabric'));
    // }

    // public function storeStock(StoreFabricStockRequest $request, Fabric $fabric)
    // {
    //     $fabric->stocks()->create($request->validated());

    //     return redirect()->route('admin.fabrics.stocks.index', $fabric)->with('success', 'Stock added successfully.');
    // }
}
