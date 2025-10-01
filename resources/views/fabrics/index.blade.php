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
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Fabric</a>
            <a href="{{ route('admin.fabrics.trash') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">View Trash</a>
        </div>
    </div>

    <details class="bg-white shadow rounded-lg mb-4" open>
        <summary class="font-semibold p-4 cursor-pointer">Advanced Search</summary>
        <div class="p-4 border-t">
            <form id="search-form" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700">Supplier Name</label>
                        <input type="text" name="company_name" id="company_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="fabric_no" class="block text-sm font-medium text-gray-700">Fabric No</label>
                        <input type="text" name="fabric_no" id="fabric_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="composition" class="block text-sm font-medium text-gray-700">Composition</label>
                        <input type="text" name="composition" id="composition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="production_type" class="block text-sm font-medium text-gray-700">Production Type</label>
                        <select name="production_type" id="production_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">All</option>
                            <option value="knitted">Knitted</option>
                            <option value="woven">Woven</option>
                            <option value="non_woven">Non-Woven</option>
                        </select>
                    </div>
                    <div>
                        <label for="stock_status" class="block text-sm font-medium text-gray-700">Stock Status</label>
                        <select name="stock_status" id="stock_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">All</option>
                            <option value="in_stock">In Stock</option>
                            <option value="out_of_stock">Out of Stock</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Search</button>
                    <button type="button" id="clear-button" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Clear</button>
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
                <!-- Rows will be injected by JavaScript -->
            </tbody>
        </table>
    </div>
    <div id="pagination-links" class="mt-4">
        <!-- Pagination will be injected by JavaScript -->
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.getElementById('search-form');
    const tableBody = document.getElementById('fabrics-table-body');
    const paginationLinks = document.getElementById('pagination-links');
    const clearButton = document.getElementById('clear-button');
    const API_ENDPOINT = '{{ route('api.fabrics.index') }}';

    const renderTableRows = (fabrics) => {
        tableBody.innerHTML = '';
        if (fabrics.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center py-4">No fabrics found.</td></tr>';
            return;
        }

        fabrics.forEach(fabric => {
            const showUrl = `{{ url('admin/fabrics') }}/${fabric.id}`;
            const editUrl = `{{ url('admin/fabrics') }}/${fabric.id}/edit`;
            const supplierName = fabric.supplier ? fabric.supplier.company_name : 'N/A';
            const stockBalance = fabric.stock_balance;

            const row = `
                <tr class="border-b border-gray-200 hover:bg-gray-100" id="fabric-row-${fabric.id}">
                    <td class="py-3 px-6 text-left whitespace-nowrap"><div class="flex items-center"><span class="font-medium">${fabric.fabric_no}</span></div></td>
                    <td class="py-3 px-6 text-left">${fabric.barcode_no || 'N/A'}</td>
                    <td class="py-3 px-6 text-left"><div class="flex items-center"><span>${fabric.composition}</span></div></td>
                    <td class="py-3 px-6 text-center"><span>${fabric.gsm}</span></td>
                    <td class="py-3 px-6 text-center"><span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">${supplierName}</span></td>
                    <td class="py-3 px-6 text-center"><span>${stockBalance}</span></td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="${showUrl}" class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center mr-2 transform hover:scale-110" title="View"><i class="fas fa-eye"></i></a>
                            <a href="${editUrl}" class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center mr-2 transform hover:scale-110" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <button data-id="${fabric.id}" class="delete-button w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center transform hover:scale-110" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>`;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
    };

    const renderPagination = (meta) => {
        paginationLinks.innerHTML = '';
        if (!meta || meta.last_page <= 1) return;

        let html = '<nav class="flex items-center justify-between">';
        html += `<p class="text-sm text-gray-700">Showing ${meta.from} to ${meta.to} of ${meta.total} results</p>`;
        html += '<div class="flex-1 flex justify-end">';

        meta.links.forEach(link => {
            const url = link.url ? `data-url="${link.url}"` : '';
            const disabled = !link.url ? 'disabled' : '';
            const activeClass = link.active ? 'bg-blue-500 text-white' : 'bg-white';
            html += `<button ${url} ${disabled} class="pagination-link mx-1 px-3 py-1 text-sm font-medium rounded-md ${activeClass} border border-gray-300 hover:bg-gray-100">${link.label.replace('&laquo;', '').replace('&raquo;', '')}</button>`;
        });

        html += '</div></nav>';
        paginationLinks.innerHTML = html;
    };

    const fetchData = async (url) => {
        tableBody.innerHTML = '<tr><td colspan="7" class="text-center py-4">Loading...</td></tr>';
        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            if (!response.ok) throw new Error('Network response was not ok');

            const result = await response.json();
            renderTableRows(result.data);
            renderPagination(result.meta);

        } catch (error) {
            console.error('Fetch Error:', error);
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-red-500">Failed to load data. Please try again.</td></tr>';
        }
    };

    const handleSearch = (e) => {
        e.preventDefault();
        const formData = new FormData(searchForm);
        const params = new URLSearchParams(formData);
        fetchData(`${API_ENDPOINT}?${params.toString()}`);
    };

    const handlePaginationClick = (e) => {
        const button = e.target.closest('.pagination-link');
        if (button && !button.disabled) {
            const url = button.dataset.url;
            if (url) fetchData(url);
        }
    };

    const handleDelete = async (e) => {
        const button = e.target.closest('.delete-button');
        if (button) {
            const fabricId = button.dataset.id;
            if (confirm('Are you sure you want to move this fabric to trash?')) {
                try {
                    const response = await fetch(`${API_ENDPOINT}/${fabricId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (response.ok) {
                        document.getElementById(`fabric-row-${fabricId}`).remove();
                    } else {
                        throw new Error('Failed to delete fabric.');
                    }
                } catch (error) {
                    console.error('Delete Error:', error);
                    alert('An error occurred. Could not delete the fabric.');
                }
            }
        }
    };

    // Initial data load
    fetchData(API_ENDPOINT);

    // Event Listeners
    searchForm.addEventListener('submit', handleSearch);
    paginationLinks.addEventListener('click', handlePaginationClick);
    tableBody.addEventListener('click', handleDelete);
    clearButton.addEventListener('click', () => {
        searchForm.reset();
        fetchData(API_ENDPOINT);
    });
});
</script>
@endpush