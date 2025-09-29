<!DOCTYPE html>
<html>
<head>
    <title>Add Supplier</title>
</head>
<body>
    <h1>Add Supplier</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <label>Country: <input type="text" name="country" required></label><br>
        <label>Company Name: <input type="text" name="company_name" required></label><br>
        <label>Code: <input type="text" name="code" required></label><br>
        <label>Email: <input type="email" name="email"></label><br>
        <label>Phone: <input type="text" name="phone"></label><br>
        <label>Address: <textarea name="address"></textarea></label><br>
        <label>Representative Name: <input type="text" name="representative_name"></label><br>
        <label>Representative Email: <input type="email" name="representative_email"></label><br>
        <label>Representative Phone: <input type="text" name="representative_phone"></label><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>