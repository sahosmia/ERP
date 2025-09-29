<!DOCTYPE html>
<html>
<head>
    <title>Suppliers</title>
</head>
<body>
    <h1>Suppliers</h1>
    <a href="{{ route('suppliers.create') }}">Add Supplier</a>

    <form method="GET" action="{{ route('suppliers.index') }}">
        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Country</th>
                <th>Code</th>
                <th>Representative</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->company_name }}</td>
                    <td>{{ $supplier->country }}</td>
                    <td>{{ $supplier->code }}</td>
                    <td>{{ $supplier->representative_name }}</td>
                    <td>
                        <a href="{{ route('suppliers.show', $supplier) }}">View</a>
                        <a href="{{ route('suppliers.edit', $supplier) }}">Edit</a>
                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $suppliers->links() }}
</body>
</html>