@extends('layouts.admin')

@section('title', 'Edit Fabric')

@section('header')
    <h1 class="text-2xl font-semibold">Edit Fabric</h1>
@endsection

@section('content')
    <div class="w-full">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="{{ route('fabrics.update', $fabric) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fabric_no">
                            Fabric No
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="fabric_no" name="fabric_no" type="text" value="{{ $fabric->fabric_no }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="composition">
                            Composition
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="composition" name="composition" type="text" value="{{ $fabric->composition }}"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="gsm">
                            GSM
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="gsm" name="gsm" type="text" value="{{ $fabric->gsm }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="qty">
                            QTY
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="qty" name="qty" type="number" step="0.01" value="{{ $fabric->qty }}"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="cuttable_width">
                            Cuttable Width
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="cuttable_width" name="cuttable_width" type="text"
                            value="{{ $fabric->cuttable_width }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="production_type">
                            Production Type
                        </label>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="production_type" name="production_type" required>
                            <option value="Sample Yardage" @if ($fabric->production_type == 'Sample Yardage') selected @endif>Sample Yardage
                            </option>
                            <option value="SMS" @if ($fabric->production_type == 'SMS') selected @endif>SMS</option>
                            <option value="Bulk" @if ($fabric->production_type == 'Bulk') selected @endif>Bulk</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="supplier_id">
                            Supplier
                        </label>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="supplier_id" name="supplier_id" required>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @if ($fabric->supplier_id == $supplier->id) selected @endif>
                                    {{ $supplier->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            Fabric Image
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="image" name="image" type="file">
                        @if ($fabric->image_path)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $fabric->image_path) }}" alt="Fabric Image"
                                    class="w-32 h-32 object-cover rounded">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex items-center justify-between mt-6">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Update
                    </button>
                    <a href="{{ route('fabrics.index') }}"
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection