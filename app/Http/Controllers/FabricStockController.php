<?php

namespace App\Http\Controllers;

use App\Models\Fabric;
use App\Models\FabricStock;
use Illuminate\Http\Request;
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
    public function store(Request $request, Fabric $fabric)
    {
        $request->validate([
            'transaction_type' => 'required|in:in,out',
            'qty' => 'required|numeric|min:0.01',
            'remarks' => 'nullable|string',
        ]);

        $balance = $fabric->balance;

        if ($request->transaction_type === 'out' && $request->qty > $balance) {
            return back()->withErrors(['qty' => 'The quantity to issue cannot exceed the available balance.']);
        }

        FabricStock::create([
            'fabric_id' => $fabric->id,
            'transaction_type' => $request->transaction_type,
            'qty' => $request->qty,
            'barcode' => 'TXN-' . strtoupper(Str::random(10)),
            'remarks' => $request->remarks,
        ]);

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