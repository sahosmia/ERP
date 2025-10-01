@extends('layouts.admin')

@section('title', 'View Fabric')

@section('header')
<h1 class="text-2xl font-semibold">Fabric Details</h1>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-4">Fabric Information</h2>
                <p class="text-gray-700 mb-2"><strong>Fabric No:</strong> {{ $fabric->fabric_no }}</p>
                <p class="text-gray-700 mb-2"><strong>Composition:</strong> {{ $fabric->composition }}</p>
                <p class="text-gray-700 mb-2"><strong>GSM:</strong> {{ $fabric->gsm }}</p>
                <p class="text-gray-700 mb-2"><strong>Quantity:</strong> {{ $fabric->qty }}</p>
                <p class="text-gray-700 mb-2"><strong>Cuttable Width:</strong> {{ $fabric->cuttable_width }}</p>
                <p class="text-gray-700 mb-2"><strong>Production Type:</strong> {{ $fabric->production_type }}</p>
                <p class="text-gray-700 mb-2"><strong>Supplier:</strong>
                    {{ $fabric->supplier->company_name ?? 'N/A' }}</p>
                <p class="text-gray-700 mb-2"><strong>Added By:</strong> {{ $fabric->addedBy->name ?? 'N/A' }}</p>
                <p class="text-gray-700 mb-2"><strong>Updated By:</strong> {{ $fabric->updatedBy->name ?? 'N/A' }}
                </p>
            </div>
            <div>
                @if ($fabric->image_path)
                <h2 class="text-xl font-semibold mb-4">Fabric Image</h2>
                <img src="{{ asset('storage/' . $fabric->image_path) }}" alt="Fabric Image"
                    class="w-full h-auto max-w-32 max-h-32 object-cover rounded shadow-lg">
                @endif
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Barcode</h2>
            @if ($fabric->barcode_no)
                <div class="mb-4">
                    {!! DNS1D::getBarcodeHTML($fabric->barcode_no, 'C39', 2, 60) !!}
                    <p class="text-center text-lg mt-2">{{ $fabric->barcode_no }}</p>
                </div>
                <a href="{{ route('admin.fabrics.print-barcode', $fabric) }}" target="_blank"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Print Barcode
                </a>
            @else
                <p class="text-gray-700">No barcode generated for this fabric.</p>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.fabrics.index') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
<<<<<<< HEAD

             <a href="{{ route('admin.fabrics.stocks', $fabric) }}"
=======
            <a href="{{ route('admin.fabrics.stocks.index', $fabric) }}"
>>>>>>> 61f1514686cfca3fe4033e56e77a8d7a9351d40a
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">
                View Stocks
            </a>
        </div>
    </div>

    <!-- Notes Section -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-xl font-semibold mb-4">Notes</h2>

        <!-- Form to add a new note -->
        <form action="{{ route('admin.notes.store') }}" method="POST" class="mb-6">
            @csrf
            <input type="hidden" name="notable_id" value="{{ $fabric->id }}">
            <input type="hidden" name="notable_type" value="{{ get_class($fabric) }}">

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
            @forelse ($fabric->notes()->latest()->get() as $note)
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
