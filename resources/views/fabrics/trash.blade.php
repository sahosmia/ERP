@extends('layouts.admin')

@section('title', 'Trashed Fabrics')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Trashed Fabrics</h1>
        <a href="{{ route('admin.fabrics.index') }}"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Back to Fabrics
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
                        <th class="py-3 px-6 text-left">Fabric No</th>
                        <th class="py-3 px-6 text-left">Composition</th>
                        <th class="py-3 px-6 text-center">Supplier</th>
                        <th class="py-3 px-6 text-center">Deleted At</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($trashedFabrics as $fabric)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <span class="font-medium">{{ $fabric->fabric_no }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span>{{ $fabric->composition }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span>{{ $fabric->supplier->company_name ?? 'N/A' }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span>{{ $fabric->deleted_at->format('Y-m-d H:i:s') }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <form action="{{ route('admin.fabrics.restore', $fabric->id) }}" method="POST"
                                        class="inline-block mr-2"
                                        onsubmit="return confirm('Are you sure you want to restore this fabric?');">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.fabrics.force-delete', $fabric->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to permanently delete this fabric? This action cannot be undone.');">
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
                            <td colspan="5" class="py-3 px-6 text-center">No trashed fabrics found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $trashedFabrics->links() }}
    </div>
@endsection