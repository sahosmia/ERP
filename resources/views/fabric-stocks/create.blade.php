@extends('layouts.admin')

@section('title', 'Add Stock for ' . $fabric->fabric_no)

@section('header')
    <h1 class="text-2xl font-semibold">Add Stock for <span class="font-bold">{{ $fabric->fabric_no }}</span></h1>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <form action="{{ route('admin.fabrics.stocks.store', $fabric) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="transaction_type" class="block text-gray-700 text-sm font-bold mb-2">Transaction Type</label>
                <select name="transaction_type" id="transaction_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="in">In</option>
                    <option value="out">Out</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="qty" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                <input type="number" name="qty" id="qty" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" step="0.01" min="0.01" required>
            </div>

            <div class="mb-4">
                <label for="barcode" class="block text-gray-700 text-sm font-bold mb-2">Barcode (Optional)</label>
                <input type="text" name="barcode" id="barcode" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Stock
                </button>
                <a href="{{ route('admin.fabrics.stocks.index', $fabric) }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
