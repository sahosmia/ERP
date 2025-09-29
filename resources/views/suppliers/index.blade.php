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
            <form method="GET" action="{{ route('admin.suppliers.index') }}" class="flex">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <button type="submit"
                    class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Search</button>
            </form>
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