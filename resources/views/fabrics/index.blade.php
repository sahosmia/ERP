@extends('layouts.admin')

@section('title', 'Fabrics')

@section('header')
<h1 class="text-2xl font-semibold">Fabrics</h1>
@endsection

@section('content')
<div class="w-full">
    <div class="flex justify-between items-center mb-4">
        <div>
            <a href="{{ route('admin.fabrics.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                Fabric</a>
            <a href="{{ route('admin.fabrics.trash') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">View Trash</a>
        </div>
    </div>

    <details class="bg-white shadow rounded-lg mb-4">
        <summary class="font-semibold p-4 cursor-pointer">Advanced Search</summary>
        <div class="p-4 border-t">
            <form id="search-form" method="GET" action="{{ route('admin.fabrics.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700">Company/Factory
                            Name</label>
                        <input type="text" name="company_name" id="company_name"
                            value="{{ request('company_name') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="fabric_no" class="block text-sm font-medium text-gray-700">Fabric No</label>
                        <input type="text" name="fabric_no" id="fabric_no" value="{{ request('fabric_no') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="composition" class="block text-sm font-medium text-gray-700">Composition</label>
                        <input type="text" name="composition" id="composition"
                            value="{{ request('composition') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="production_type"
                            class="block text-sm font-medium text-gray-700">Production Type</label>
                        <select name="production_type" id="production_type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">All</option>
                            <option value="knitted" {{ request('production_type') == 'knitted' ? 'selected' : '' }}>
                                Knitted</option>
                            <option value="woven" {{ request('production_type') == 'woven' ? 'selected' : '' }}>
                                Woven</option>
                            <option value="non_woven" {{ request('production_type') == 'non_woven' ? 'selected' : '' }}>
                                Non-Woven</option>
                        </select>
                    </div>
                    <div>
                        <label for="stock_status" class="block text-sm font-medium text-gray-700">Stock
                            Status</label>
                        <select name="stock_status" id="stock_status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">All</option>
                            <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock
                            </option>
                            <option value="out_of_stock"
                                {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Search
                    </button>
                    <a href="{{ route('admin.fabrics.index') }}"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Clear
                    </a>
                </div>
            </form>
        </div>
    </details>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Fabric No</th>
                    <th class="py-3 px-6 text-left">Barcode</th>
                    <th class="py-3 px-6 text-left">Composition</th>
                    <th class="py-3 px-6 text-center">GSM</th>
                    <th class="py-3 px-6 text-center">Supplier</th>
                    <th class="py-3 px-6 text-center">Stock Balance</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="fabrics-table-body" class="text-gray-600 text-sm font-light">
                @foreach ($fabrics as $fabric)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{ $fabric->fabric_no }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        @if($fabric->barcode_no)
                            <div>{!! DNS1D::getBarcodeHTML($fabric->barcode_no, 'C39', 1, 33) !!}</div>
                            <div class="text-xs">{{ $fabric->barcode_no }}</div>
                        @else
                            N/A
                        @endif
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
                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{
                            $fabric->supplier->company_name ?? 'N/A' }}</span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span>{{ ($fabric->stock_in ?? 0) - ($fabric->stock_out ?? 0) }}</span>
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
    <div id="pagination-links">
        {{ $fabrics->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('search-form');

    const updateTable = (data) => {
        const tableBody = document.getElementById('fabrics-table-body');
        const paginationLinks = document.getElementById('pagination-links');
        tableBody.innerHTML = '';

        if (data.data && data.data.length > 0) {
            data.data.forEach(fabric => {
                const barcodeHtml = fabric.barcode_no ? `<div>${fabric.barcode_no}</div>` : 'N/A';
                const supplierName = fabric.supplier ? fabric.supplier.company_name : 'N/A';
                const stockBalance = (fabric.stock_in || 0) - (fabric.stock_out || 0);

                const showUrl = `{{ url('admin/fabrics') }}/${fabric.id}`;
                const editUrl = `{{ url('admin/fabrics') }}/${fabric.id}/edit`;
                const destroyUrl = `{{ url('admin/fabrics') }}/${fabric.id}`;

                const row = `
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap"><div class="flex items-center"><span class="font-medium">${fabric.fabric_no}</span></div></td>
                        <td class="py-3 px-6 text-left">${barcodeHtml}</td>
                        <td class="py-3 px-6 text-left"><div class="flex items-center"><span>${fabric.composition}</span></div></td>
                        <td class="py-3 px-6 text-center"><span>${fabric.gsm}</span></td>
                        <td class="py-3 px-6 text-center"><span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">${supplierName}</span></td>
                        <td class="py-3 px-6 text-center"><span>${stockBalance}</span></td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="${showUrl}" class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center mr-2 transform hover:scale-110"><i class="fas fa-eye"></i></a>
                                <a href="${editUrl}" class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center mr-2 transform hover:scale-110"><i class="fas fa-pencil-alt"></i></a>
                                <form action="${destroyUrl}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to move this fabric to trash?');">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center transform hover:scale-110"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>`;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        } else {
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center py-4">No fabrics found.</td></tr>';
        }

        if (data.links_html) {
            paginationLinks.innerHTML = data.links_html;
        } else {
            paginationLinks.innerHTML = '';
        }
    };

    const fetchData = (url) => {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            updateTable(data);
        })
        .catch(error => {
            console.error('Error:', error);
            const tableBody = document.getElementById('fabrics-table-body');
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-red-500">An error occurred while fetching data.</td></tr>';
        });
    };

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);
        const url = `{{ route('api.fabrics.index') }}?${params.toString()}`;
        fetchData(url);
    });

    document.getElementById('pagination-links').addEventListener('click', function (e) {
        const anchor = e.target.closest('a');
        if (anchor) {
            e.preventDefault();
            const url = anchor.href;
            if (!url) return;
            fetchData(url);
        }
    });
});
</script>
@endpush