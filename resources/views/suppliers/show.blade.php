@extends('layouts.admin')

@section('title', 'View Supplier')

@section('header')
<h1 class="text-2xl font-semibold">Supplier Details</h1>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-4">Company Information</h2>
                <p class="text-gray-700 mb-2"><strong>Company Name:</strong> {{ $supplier->company_name }}</p>
                <p class="text-gray-700 mb-2"><strong>Country:</strong> {{ $supplier->country }}</p>
                <p class="text-gray-700 mb-2"><strong>Code:</strong> {{ $supplier->code }}</p>
                <p class="text-gray-700 mb-2"><strong>Email:</strong> {{ $supplier->email }}</p>
                <p class="text-gray-700 mb-2"><strong>Phone:</strong> {{ $supplier->phone }}</p>
                <p class="text-gray-700 mb-2"><strong>Address:</strong> {{ $supplier->address }}</p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-4">Representative Information</h2>
                <p class="text-gray-700 mb-2"><strong>Name:</strong> {{ $supplier->representative_name }}</p>
                <p class="text-gray-700 mb-2"><strong>Email:</strong> {{ $supplier->representative_email }}</p>
                <p class="text-gray-700 mb-2"><strong>Phone:</strong> {{ $supplier->representative_phone }}</p>
            </div>
        </div>
        <div class="mt-6 border-t pt-4">
            <p class="text-gray-700 mb-2"><strong>Added By:</strong> {{ $supplier->addedBy->name ?? 'N/A' }}</p>
            <p class="text-gray-700"><strong>Updated By:</strong> {{ $supplier->updatedBy->name ?? 'N/A' }}</p>
        </div>
        <div class="mt-6">
            <a href="{{ route('admin.suppliers.index') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
