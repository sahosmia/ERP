<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
</head>
<body>
    <h1>Edit Supplier</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Country: <input type="text" name="country" value="{{ $supplier->country }}" required></label><br>
        <label>Company Name: <input type="text" name="company_name" value="{{ $supplier->company_name }}" required></label><br>
        <label>Code: <input type="text" name="code" value="{{ $supplier->code }}" required></label><br>
        <label>Email: <input type="email" name="email" value="{{ $supplier->email }}"></label><br>
        <label>Phone: <input type="text" name="phone" value="{{ $supplier->phone }}"></label><br>
        <label>Address: <textarea name="address">{{ $supplier->address }}</textarea></label><br>
        <label>Representative Name: <input type="text" name="representative_name" value="{{ $supplier->representative_name }}"></label><br>
        <label>Representative Email: <input type="email" name="representative_email" value="{{ $supplier->representative_email }}"></label><br>
        <label>Representative Phone: <input type="text" name="representative_phone" value="{{ $supplier->representative_phone }}"></label><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>