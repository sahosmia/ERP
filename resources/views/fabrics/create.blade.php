<!DOCTYPE html>
<html>
<head>
    <title>Add Fabric</title>
</head>
<body>
    <h1>Add Fabric</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('fabrics.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Fabric No: <input type="text" name="fabric_no" required></label><br>
        <label>Composition: <input type="text" name="composition" required></label><br>
        <label>GSM: <input type="text" name="gsm" required></label><br>
        <label>QTY: <input type="number" step="0.01" name="qty" required></label><br>
        <label>Cuttable Width: <input type="text" name="cuttable_width" required></label><br>
        <label>Production Type:
            <select name="production_type" required>
                <option value="Sample Yardage">Sample Yardage</option>
                <option value="SMS">SMS</option>
                <option value="Bulk">Bulk</option>
            </select>
        </label><br>
        <label>Supplier:
            <select name="supplier_id" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                @endforeach
            </select>
        </label><br>
        <label>Fabric Image: <input type="file" name="image"></label><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>