<!DOCTYPE html>
<html>
<head>
    <title>View Supplier</title>
</head>
<body>
    <h1>Supplier Details</h1>
    <p><strong>Country:</strong> {{ $supplier->country }}</p>
    <p><strong>Company Name:</strong> {{ $supplier->company_name }}</p>
    <p><strong>Code:</strong> {{ $supplier->code }}</p>
    <p><strong>Email:</strong> {{ $supplier->email }}</p>
    <p><strong>Phone:</strong> {{ $supplier->phone }}</p>
    <p><strong>Address:</strong> {{ $supplier->address }}</p>
    <p><strong>Representative Name:</strong> {{ $supplier->representative_name }}</p>
    <p><strong>Representative Email:</strong> {{ $supplier->representative_email }}</p>
    <p><strong>Representative Phone:</strong> {{ $supplier->representative_phone }}</p>
    <p><strong>Added By:</strong> {{ $supplier->addedBy->name ?? 'N/A' }}</p>
    <p><strong>Updated By:</strong> {{ $supplier->updatedBy->name ?? 'N/A' }}</p>
    <a href="{{ route('suppliers.index') }}">Back to List</a>
</body>
</html>