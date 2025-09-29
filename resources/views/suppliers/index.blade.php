@extends('layouts.admin')

@section('title', 'Suppliers')

@section('header')
<h1 class="text-2xl font-semibold">Suppliers</h1>
@endsection

@section('content')
<div class="w-full">
    <div class="flex justify-between items-center mb-4">
        <div>
            <a href="{{ route('admin.suppliers.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Supplier</a>
            <a href="{{ route('admin.suppliers.trash') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">View Trash</a>
        </div>
        <details class="bg-white shadow rounded-lg mb-4">
            <summary class="font-semibold p-4 cursor-pointer">Advanced Search</summary>
            <div class="p-4 border-t">
                <form method="GET" action="{{ route('admin.suppliers.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700">Company
                                Name</label>
                            <input type="text" name="company_name" id="company_name"
                                value="{{ request('company_name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="representative" class="block text-sm font-medium text-gray-700">Representative</label>
                            <input type="text" name="representative" id="representative"
                                value="{{ request('representative') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                            <input type="text" name="country" id="country" value="{{ request('country') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Date Range</label>
                            <div class="flex space-x-2">
                                <input type="date" name="start_date" id="start_date"
                                    value="{{ request('start_date') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Search
                        </button>
                        <a href="{{ route('admin.suppliers.index') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Clear
                        </a>
                    </div>
                </form>
            </div>
        </details>
    </div>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Company Name</th>
                    <th class="py-3 px-6 text-left">Country</th>
                    <th class="py-3 px-6 text-center">Code</th>
                    <th class="py-3 px-6 text-center">Representative</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($suppliers as $supplier)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{ $supplier->company_name }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{ $supplier->country }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span>{{ $supplier->code }}</span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span>{{ $supplier->representative_name }}</span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="{{ route('admin.suppliers.show', $supplier) }}"
                                class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center mr-2 transform hover:scale-110">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.suppliers.edit', $supplier) }}"
                                class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center mr-2 transform hover:scale-110">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Are you sure you want to move this supplier to trash?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center transform hover:scale-110">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $suppliers->links() }}
</div>
@endsection
