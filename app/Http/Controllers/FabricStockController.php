<?php

namespace App\Http\Controllers;

use App\Models\Fabric;
use App\Models\FabricStock;
use App\Services\FabricStockService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FabricStockController extends Controller
{
    protected $fabricStockService;

    public function __construct(FabricStockService $fabricStockService)
    {
        $this->fabricStockService = $fabricStockService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function index(Fabric $fabric)
    {
        $stocks = $fabric->stocks()->latest()->paginate(15);
        return view('fabric-stocks.index', compact('fabric', 'stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function create(Fabric $fabric)
    {
        return view('fabric-stocks.create', compact('fabric'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fabric $fabric)
    {
        $request->validate([
            'transaction_type' => 'required|in:in,out',
            'qty' => 'required|numeric|min:0.01',
            'remarks' => 'nullable|string',
        ]);

        try {
            $this->fabricStockService->createStockTransaction($fabric, $request->all());
        } catch (\Exception $e) {
            return back()->withErrors(['qty' => $e->getMessage()]);
        }

        return redirect()->route('admin.fabrics.stocks.index', $fabric)->with('success', 'Stock transaction recorded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fabric  $fabric
     * @param  \App\Models\FabricStock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fabric $fabric, FabricStock $stock)
    {
        $stock->delete();
        return redirect()->route('admin.fabrics.stocks.index', $fabric)->with('success', 'Stock transaction deleted successfully.');
    }
}
