@extends('layouts.admin')

@section('title', 'Add Stock Transaction - ' . $fabric->fabric_no)

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-semibold">Add Stock Transaction</h1>
        <h2 class="text-lg font-medium text-gray-600">{{ $fabric->fabric_no }}</h2>
    </div>
    <a href="{{ route('admin.fabrics.stocks.index', $fabric) }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Back to Stock List
    </a>
</div>
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
        <form action="{{ route('admin.fabrics.stocks.store', $fabric) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="transaction_type">
                        Transaction Type
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="transaction_type" name="transaction_type" required>
                        <option value="in">Stock In</option>
                        <option value="out">Stock Out</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="qty">
                        Quantity
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="qty" name="qty" type="number" step="0.01" placeholder="Quantity" required>
                </div>
                <div class="mb-4 md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="remarks">
                        Remarks
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="remarks" name="remarks" placeholder="Add any relevant remarks"></textarea>
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Save Transaction
                </button>
                <a href="{{ route('admin.fabrics.stocks.index', $fabric) }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection