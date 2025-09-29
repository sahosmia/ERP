@extends('layouts.admin')

@section('title', 'Fabrics')

@section('header')
    <h1 class="text-2xl font-semibold">Fabrics</h1>
@endsection

@section('content')
    <div class="w-full">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('admin.fabrics.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                Fabric</a>
            <a href="{{ route('admin.fabrics.trash') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">View Trash</a>
        </div>

        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Fabric No</th>
                        <th class="py-3 px-6 text-left">Composition</th>
                        <th class="py-3 px-6 text-center">GSM</th>
                        <th class="py-3 px-6 text-center">Supplier</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($fabrics as $fabric)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ $fabric->fabric_no }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $fabric->composition }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span>{{ $fabric->gsm }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span
                                    class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $fabric->supplier->company_name ?? 'N/A' }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.fabrics.show', $fabric) }}"
                                        class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center mr-2 transform hover:scale-110">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.fabrics.edit', $fabric) }}"
                                        class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center mr-2 transform hover:scale-110">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.fabrics.destroy', $fabric) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to move this fabric to trash?');">
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
        {{ $fabrics->links() }}
    </div>
@endsection