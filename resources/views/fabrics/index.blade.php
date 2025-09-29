<!DOCTYPE html>
<html>
<head>
    <title>Fabrics</title>
</head>
<body>
    <h1>Fabrics</h1>
    <a href="{{ route('fabrics.create') }}">Add Fabric</a>

    <table border="1">
        <thead>
            <tr>
                <th>Fabric No</th>
                <th>Composition</th>
                <th>GSM</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fabrics as $fabric)
                <tr>
                    <td>{{ $fabric->fabric_no }}</td>
                    <td>{{ $fabric->composition }}</td>
                    <td>{{ $fabric->gsm }}</td>
                    <td>{{ $fabric->supplier->company_name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('fabrics.show', $fabric) }}">View</a>
                        <a href="{{ route('fabrics.edit', $fabric) }}">Edit</a>
                        <form action="{{ route('fabrics.destroy', $fabric) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $fabrics->links() }}
</body>
</html>