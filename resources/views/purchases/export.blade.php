<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                border: 1px solid #d9d9d9;
                padding: 8px;
                text-align: left;
            }

            th {
                background: #0A4D2E;
                color: #ffffff;
                font-weight: bold;
            }

            .amount {
                text-align: right;
            }

            .total-label,
            .total-value {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Categoria</th>
                    <th>Valor COP</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Metodo de pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->title }}</td>
                        <td>{{ $purchase->description }}</td>
                        <td>{{ $purchase->category?->name }}</td>
                        <td class="amount">{{ \App\Support\Currency::cop($purchase->amount) }}</td>
                        <td>{{ $purchase->purchase_date?->format('Y-m-d') }}</td>
                        <td>{{ $purchase->provider }}</td>
                        <td>{{ $purchase->payment_method }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="3" class="total-label">Total gastos</td>
                    <td class="amount total-value">{{ \App\Support\Currency::cop($total) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
