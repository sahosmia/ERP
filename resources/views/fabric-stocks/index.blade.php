@extends('layouts.admin')

@section('title', 'Fabric Stocks for ' . $fabric->fabric_no)

@section('header')
    <h1 class="text-2xl font-semibold">Fabric Stocks for <span class="font-bold">{{ $fabric->fabric_no }}</span></h1>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-6 pb-4 border-b">
            <h2 class="text-xl font-semibold mb-2">Fabric Summary</h2>
            <p class="text-gray-700"><strong>Available Balance:</strong> {{ $fabric->balance }}</p>
            @if ($fabric->barcode_no)
                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Barcode</h3>
                    {!! DNS1D::getBarcodeHTML($fabric->barcode_no, 'C39', 2, 60) !!}
                    <p class="text-center text-lg mt-2">{{ $fabric->barcode_no }}</p>
                </div>
            @endif
        </div>

        <div class="mb-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold">Stock Transactions</h2>
            <a href="{{ route('admin.fabrics.stocks.create', $fabric) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add Stock
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction Type</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantity</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Barcode</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stocks as $stock)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">{{ ucfirst($stock->transaction_type) }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $stock->qty }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $stock->barcode }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $stock->created_at->format('d-m-Y H:i:s') }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                <form action="{{ route('admin.fabrics.stocks.destroy', [$fabric, $stock]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this stock transaction?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">No stock transactions found for this fabric.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $stocks->links() }}
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.fabrics.show', $fabric) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to Fabric Details
            </a>
        </div>
    </div>
</div>
@endsection