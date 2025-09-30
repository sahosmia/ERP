@extends('layouts.admin')

@section('title', 'Fabric Stock - ' . $fabric->fabric_no)

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-semibold">Fabric Stock</h1>
        <h2 class="text-lg font-medium text-gray-600">{{ $fabric->fabric_no }}</h2>
    </div>
    <a href="{{ route('admin.fabrics.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Back to Fabrics
    </a>
</div>
@endsection

@section('content')
<div class="w-full">
    <div class="flex justify-between items-center mb-4">
        <div>
            <a href="{{ route('admin.fabrics.stocks.create', $fabric) }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Stock Transaction</a>
        </div>
        <div class="text-right">
            <p class="text-gray-700 font-bold text-lg">Available Balance: {{ $fabric->balance }}</p>
        </div>
    </div>

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Date</th>
                    <th class="py-3 px-6 text-left">Transaction Type</th>
                    <th class="py-3 px-6 text-center">Quantity</th>
                    <th class="py-3 px-6 text-left">Remarks</th>
                    <th class="py-3 px-6 text-center">Barcode</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($stocks as $stock)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        {{ $stock->created_at->format('Y-m-d H:i:s') }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        @if ($stock->transaction_type === 'in')
                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Stock In</span>
                        @else
                        <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Stock Out</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        {{ $stock->qty }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ $stock->remarks ?? 'N/A' }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if($stock->barcode)
                        <div>{!! DNS1D::getBarcodeHTML($stock->barcode, 'C39', 1, 33) !!}</div>
                        <div class="text-xs">{{ $stock->barcode }}</div>
                        @else
                        N/A
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        <form action="{{ route('admin.fabrics.stocks.destroy', ['fabric' => $fabric, 'stock' => $stock]) }}" method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center transform hover:scale-110">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-3 px-6 text-center">No stock transactions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $stocks->links() }}
</div>
@endsection