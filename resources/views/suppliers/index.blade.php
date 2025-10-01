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
    </div>

    <details class="bg-white shadow rounded-lg mb-4" open>
        <summary class="font-semibold p-4 cursor-pointer">Advanced Search</summary>
        <div class="p-4 border-t">
            <form id="search-form" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                        <input type="text" name="company_name" id="company_name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="representative_name" class="block text-sm font-medium text-gray-700">Representative</label>
                        <input type="text" name="representative_name" id="representative_name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                        <input type="text" name="country" id="country"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Date Range</label>
                        <div class="flex space-x-2">
                            <input type="date" name="start_date" id="start_date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="date" name="end_date" id="end_date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Search
                    </button>
                    <button type="button" id="clear-button"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Clear
                    </button>
                </div>
            </form>
        </div>
    </details>

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
            <tbody id="suppliers-table-body" class="text-gray-600 text-sm font-light">
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
    const tableBody = document.getElementById('suppliers-table-body');
    const paginationLinks = document.getElementById('pagination-links');
    const clearButton = document.getElementById('clear-button');
    const API_ENDPOINT = '{{ route('api.suppliers.index') }}';

    const renderTableRows = (suppliers) => {
        tableBody.innerHTML = '';
        if (suppliers.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-4">No suppliers found.</td></tr>';
            return;
        }

        suppliers.forEach(supplier => {
            const showUrl = `{{ url('admin/suppliers') }}/${supplier.id}`;
            const editUrl = `{{ url('admin/suppliers') }}/${supplier.id}/edit`;

            const row = `
                <tr class="border-b border-gray-200 hover:bg-gray-100" id="supplier-row-${supplier.id}">
                    <td class="py-3 px-6 text-left whitespace-nowrap"><div class="flex items-center"><span class="font-medium">${supplier.company_name}</span></div></td>
                    <td class="py-3 px-6 text-left"><div class="flex items-center"><span>${supplier.country}</span></div></td>
                    <td class="py-3 px-6 text-center"><span>${supplier.code}</span></td>
                    <td class="py-3 px-6 text-center"><span>${supplier.representative_name}</span></td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="${showUrl}" class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center mr-2 transform hover:scale-110" title="View"><i class="fas fa-eye"></i></a>
                            <a href="${editUrl}" class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center mr-2 transform hover:scale-110" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <button data-id="${supplier.id}" class="delete-button w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center transform hover:scale-110" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>`;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
    };

    const renderPagination = (meta, links) => {
        paginationLinks.innerHTML = '';
        if (!meta || meta.last_page === 1) return;

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
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-4">Loading...</td></tr>';
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
            renderPagination(result.meta, result.links);

        } catch (error) {
            console.error('Fetch Error:', error);
            tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-red-500">Failed to load data. Please try again.</td></tr>';
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
            const supplierId = button.dataset.id;
            if (confirm('Are you sure you want to move this supplier to trash?')) {
                try {
                    const response = await fetch(`${API_ENDPOINT}/${supplierId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (response.ok) {
                        document.getElementById(`supplier-row-${supplierId}`).remove();
                        // Optionally, show a success notification
                    } else {
                        throw new Error('Failed to delete supplier.');
                    }
                } catch (error) {
                    console.error('Delete Error:', error);
                    alert('An error occurred. Could not delete the supplier.');
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