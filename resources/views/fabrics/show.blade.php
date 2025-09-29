@extends('layouts.admin')

@section('title', 'View Fabric')

@section('header')
<h1 class="text-2xl font-semibold">Fabric Details</h1>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-4">Fabric Information</h2>
                <p class="text-gray-700 mb-2"><strong>Fabric No:</strong> {{ $fabric->fabric_no }}</p>
                <p class="text-gray-700 mb-2"><strong>Composition:</strong> {{ $fabric->composition }}</p>
                <p class="text-gray-700 mb-2"><strong>GSM:</strong> {{ $fabric->gsm }}</p>
                <p class="text-gray-700 mb-2"><strong>Quantity:</strong> {{ $fabric->qty }}</p>
                <p class="text-gray-700 mb-2"><strong>Cuttable Width:</strong> {{ $fabric->cuttable_width }}</p>
                <p class="text-gray-700 mb-2"><strong>Production Type:</strong> {{ $fabric->production_type }}</p>
                <p class="text-gray-700 mb-2"><strong>Supplier:</strong>
                    {{ $fabric->supplier->company_name ?? 'N/A' }}</p>
                <p class="text-gray-700 mb-2"><strong>Added By:</strong> {{ $fabric->addedBy->name ?? 'N/A' }}</p>
                <p class="text-gray-700 mb-2"><strong>Updated By:</strong> {{ $fabric->updatedBy->name ?? 'N/A' }}
                </p>
            </div>
            <div>
                @if ($fabric->image_path)
                <h2 class="text-xl font-semibold mb-4">Fabric Image</h2>
                <img src="{{ asset('storage/' . $fabric->image_path) }}" alt="Fabric Image"
                    class="w-full h-auto object-cover rounded shadow-lg">
                @endif
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Barcode</h2>
            <div class="flex items-center">
                <p class="text-gray-700 mr-4"><strong>Barcode:</strong> {{ $fabric->barcode }}</p>
                {{-- Barcode generation and printing would require a library and more complex setup --}}
                {{-- For now, just displaying the code and a placeholder button --}}
                <button onclick="window.print()"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Print Barcode
                </button>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.fabrics.index') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
