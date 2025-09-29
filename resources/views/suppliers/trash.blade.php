@extends('layouts.admin')

@section('title', 'Trashed Suppliers')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Trashed Suppliers</h1>
        <a href="{{ route('admin.suppliers.index') }}"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Back to Suppliers
        </a>
    </div>
@endsection

@section('content')
    <div class="w-full">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Company Name</th>
                        <th class="py-3 px-6 text-left">Country</th>
                        <th class="py-3 px-6 text-center">Deleted At</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($trashedSuppliers as $supplier)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <span class="font-medium">{{ $supplier->company_name }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span>{{ $supplier->country }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span>{{ $supplier->deleted_at->format('Y-m-d H:i:s') }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <form action="{{ route('admin.suppliers.restore', $supplier->id) }}" method="POST"
                                        class="inline-block mr-2"
                                        onsubmit="return confirm('Are you sure you want to restore this supplier?');">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.suppliers.force-delete', $supplier->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to permanently delete this supplier? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Delete Permanently
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-3 px-6 text-center">No trashed suppliers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $trashedSuppliers->links() }}
    </div>
@endsection