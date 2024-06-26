<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Venta #{{ $sale->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .content-wrapper {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            margin: 0 auto;
        }
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .page-header h1 {
            color: #4CAF50;
        }
        .provider-info, .sale-info {
            margin-bottom: 20px;
        }
        .provider-info p, .sale-info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #4CAF50;
            color: white;
            text-align: left;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        .total-row {
            font-weight: bold;
        }
        .right-align {
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="page-header">
            <h1>Detalles de Venta</h1>
        </div>
        
        <div class="provider-info">
            <h3>Información del Vendedor</h3>
            <p><strong>Nombre:</strong> {{ $sale->user->name }}</p>
            <p><strong>Email:</strong> {{ $sale->user->email }}</p>
        </div>

        <div class="sale-info">
            <h3>Información de la Venta</h3>
            <p><strong>Número Venta:</strong> {{ $sale->id }}</p>
            <p><strong>Fecha:</strong> {{ $sale->sale_date }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio (EUR)</th>
                    <th>Cantidad</th>
                    <th>Descuento (%)</th>
                    <th>Subtotal (EUR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saleDetails as $saleDetail)
                    <tr>
                        <td>{{ $saleDetail->product->name }}</td>
                        <td>{{ number_format($saleDetail->price, 2) }}</td>
                        <td>{{ $saleDetail->quantity }}</td>
                        <td>{{ $sale->discount }}%</td>
                        <td>{{ number_format($saleDetail->quantity * $saleDetail->price-$saleDetail->quantity*$saleDetail->price*$saleDetail->discount/100, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4" class="right-align">SUBTOTAL:</td>
                    <td>{{ number_format($subtotal, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4" class="right-align">TOTAL IVA({{$sale->iva}}%):</td>
                    <td>{{ number_format(($subtotal * $sale->iva) / 100, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4" class="right-align">TOTAL A PAGAR:</td>
                    <td>{{ number_format($sale->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        
    </div>
</body>
</html>
