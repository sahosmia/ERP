<?php

namespace App\Http\Controllers;

use App\Models\Fabric;
use App\Models\Supplier;
use App\Http\Requests\StoreFabricRequest;
use App\Http\Requests\UpdateFabricRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FabricController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fabrics = Fabric::with('supplier')->paginate(10);
        return view('fabrics.index', compact('fabrics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('fabrics.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFabricRequest $request)
    {
        $data = $request->validated();
        $data['added_by'] = Auth::id();
        $data['barcode'] = 'fab-'.Str::uuid();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('fabric_images', 'public');
            $data['image_path'] = $path;
        }

        Fabric::create($data);

        return redirect()->route('admin.fabrics.index')->with('success', 'Fabric created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fabric $fabric)
    {
        return view('fabrics.show', compact('fabric'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fabric $fabric)
    {
        $suppliers = Supplier::all();
        return view('fabrics.edit', compact('fabric', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFabricRequest $request, Fabric $fabric)
    {
        $data = $request->validated();
        $data['updated_by'] = Auth::id();

        if ($request->hasFile('image')) {
            // Optional: Delete old image if it exists
            // if ($fabric->image_path) {
            //     Storage::disk('public')->delete($fabric->image_path);
            // }
            $path = $request->file('image')->store('fabric_images', 'public');
            $data['image_path'] = $path;
        }

        $fabric->update($data);

        return redirect()->route('admin.fabrics.index')->with('success', 'Fabric updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fabric $fabric)
    {
        $fabric->delete();
        return redirect()->route('admin.fabrics.index')->with('success', 'Fabric moved to trash successfully.');
    }

    /**
     * Display a listing of the trashed resource.
     */
    public function trash()
    {
        $trashedFabrics = Fabric::onlyTrashed()->with('supplier')->paginate(10);
        return view('fabrics.trash', compact('trashedFabrics'));
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore($id)
    {
        $fabric = Fabric::onlyTrashed()->findOrFail($id);
        $fabric->restore();
        return redirect()->route('admin.fabrics.trash')->with('success', 'Fabric restored successfully.');
    }

    /**
     * Permanently delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $fabric = Fabric::onlyTrashed()->findOrFail($id);
        // Optional: Delete image from storage
        if ($fabric->image_path) {
            Storage::disk('public')->delete($fabric->image_path);
        }
        $fabric->forceDelete();
        return redirect()->route('admin.fabrics.trash')->with('success', 'Fabric permanently deleted.');
    }
}
