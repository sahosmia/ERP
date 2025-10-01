@extends('layouts.admin')

@section('title', 'View Supplier')

@section('header')
<h2 class="text-2xl font-semibold">Supplier Details</h2>
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

    <!-- Notes Section -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-xl font-semibold mb-4">Notes</h2>

        <!-- Form to add a new note -->
        <form action="{{ route('admin.notes.store') }}" method="POST" class="mb-6">
            @csrf
            <input type="hidden" name="notable_id" value="{{ $supplier->id }}">
            <input type="hidden" name="notable_type" value="{{ get_class($supplier) }}">

            <div class="mb-4">
                <label for="note" class="block text-gray-700 text-sm font-bold mb-2">Add a new note:</label>
                <textarea name="note" id="note" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Note
            </button>
        </form>

        <!-- Display existing notes -->
        <div class="space-y-4">
            @forelse ($supplier->notes()->latest()->get() as $note)
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-gray-800">{{ $note->note }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        Added by {{ $note->addedBy->name ?? 'Unknown' }} on {{ $note->created_at->format('M d, Y \a\t h:i A') }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500">No notes have been added yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
