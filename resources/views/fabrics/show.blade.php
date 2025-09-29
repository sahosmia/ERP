<!DOCTYPE html>
<html>
<head>
    <title>View Fabric</title>
</head>
<body>
    <h1>Fabric Details</h1>
    <p><strong>Fabric No:</strong> {{ $fabric->fabric_no }}</p>
    <p><strong>Composition:</strong> {{ $fabric->composition }}</p>
    <p><strong>GSM:</strong> {{ $fabric->gsm }}</p>
    <p><strong>Quantity:</strong> {{ $fabric->qty }}</p>
    <p><strong>Cuttable Width:</strong> {{ $fabric->cuttable_width }}</p>
    <p><strong>Production Type:</strong> {{ $fabric->production_type }}</p>
    <p><strong>Supplier:</strong> {{ $fabric->supplier->company_name ?? 'N/A' }}</p>
    <p><strong>Added By:</strong> {{ $fabric->addedBy->name ?? 'N/A' }}</p>
    <p><strong>Updated By:</strong> {{ $fabric->updatedBy->name ?? 'N/A' }}</p>

    @if ($fabric->image_path)
        <p><strong>Fabric Image:</strong></p>
        <img src="{{ asset('storage/' . $fabric->image_path) }}" alt="Fabric Image" width="200">
    @endif

    <p><strong>Barcode:</strong> {{ $fabric->barcode }}</p>
    {{-- Barcode generation and printing would require a library and more complex setup --}}
    {{-- For now, just displaying the code and a placeholder button --}}
    <button onclick="window.print()">Print Barcode</button>
    <br><br>

    <a href="{{ route('fabrics.index') }}">Back to List</a>
</body>
</html>