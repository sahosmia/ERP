<!DOCTYPE html>
<html>
<head>
    <title>Edit Fabric</title>
</head>
<body>
    <h1>Edit Fabric</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('fabrics.update', $fabric) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Fabric No: <input type="text" name="fabric_no" value="{{ $fabric->fabric_no }}" required></label><br>
        <label>Composition: <input type="text" name="composition" value="{{ $fabric->composition }}" required></label><br>
        <label>GSM: <input type="text" name="gsm" value="{{ $fabric->gsm }}" required></label><br>
        <label>QTY: <input type="number" step="0.01" name="qty" value="{{ $fabric->qty }}" required></label><br>
        <label>Cuttable Width: <input type="text" name="cuttable_width" value="{{ $fabric->cuttable_width }}" required></label><br>
        <label>Production Type:
            <select name="production_type" required>
                <option value="Sample Yardage" @if($fabric->production_type == 'Sample Yardage') selected @endif>Sample Yardage</option>
                <option value="SMS" @if($fabric->production_type == 'SMS') selected @endif>SMS</option>
                <option value="Bulk" @if($fabric->production_type == 'Bulk') selected @endif>Bulk</option>
            </select>
        </label><br>
        <label>Supplier:
            <select name="supplier_id" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @if($fabric->supplier_id == $supplier->id) selected @endif>{{ $supplier->company_name }}</option>
                @endforeach
            </select>
        </label><br>
        <label>Fabric Image: <input type="file" name="image"></label><br>
        @if ($fabric->image_path)
            <img src="{{ asset('storage/' . $fabric->image_path) }}" alt="Fabric Image" width="100">
        @endif
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>