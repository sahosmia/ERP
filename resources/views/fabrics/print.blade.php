<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Barcode - {{ $fabric->barcode_no }}</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 20px;
        }
        .print-button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 30px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .barcode-container {
            margin-bottom: 20px;
        }
        @media print {
            .print-button {
                display: none;
            }
            @page {
                size: 3in 2in; /* Example size, can be adjusted */
                margin: 0;
            }
            body {
                margin: 0.5in;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="barcode-container">
            @if ($fabric->barcode_no)
                <div>{!! DNS1D::getBarcodeHTML($fabric->barcode_no, 'C39', 3, 90) !!}</div>
                <p style="font-size: 24px; margin-top: 10px; letter-spacing: 2px;">{{ $fabric->barcode_no }}</p>
            @else
                <p>Barcode not available.</p>
            @endif
        </div>
        <button onclick="window.print();" class="print-button">Print</button>
    </div>
</body>
</html>