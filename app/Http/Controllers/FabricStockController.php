<?php

namespace App\Http\Controllers;

use App\Models\Fabric;
use App\Models\FabricStock;
use App\Http\Requests\StoreFabricStockRequest;
use Illuminate\Support\Str;

class FabricStockController extends Controller
{
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
    public function store(StoreFabricStockRequest $request, Fabric $fabric)
    {
        $validated = $request->validated();
        $balance = $fabric->balance;

        if ($validated['transaction_type'] === 'out' && $validated['qty'] > $balance) {
            return back()->withErrors(['qty' => 'The quantity to issue cannot exceed the available balance.'])->withInput();
        }

        $data = $validated;
        $data['fabric_id'] = $fabric->id;
        if (empty($validated['barcode'])) {
            $data['barcode'] = 'TXN-' . strtoupper(Str::random(10));
        }

        FabricStock::create($data);

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