<style>
    /* Table details CSS*/
    table.table-details {
        width: 100%;
        border-collapse: collapse;
        transform: translate(0, -16px);
    }
    table.table-details thead tr:nth-child(1) {
        background-color: #0074D9;
        color: white;
    }
    table.table-details thead tr:nth-child(2) {
        background-color: #DDDDDD;
        color: #1e3799;
    }
    table.table-details th, table.table-details td {
        border: 1px dashed #0074D9;
        padding: 2px 6px 2px 6px; /* top, right, bottom, left */
        font-size: 12px;
    }
    th {
        text-align: center;
    }
    table.table-details tbody tr td:nth-child(1), table.table-details tbody tr td:nth-child(4) {
        text-align: center;
    }
    table.table-details tbody tr td:nth-child(n + 5) {
        text-align: right;
    }
</style>

<table class='table-details'>
    <thead>
        <tr><th colspan='6'>DETALLE ÍTEMS</th></tr>
        <tr>
            <th>N°</th>
            <th>Código</th>
            <th>Ítem</th>
            <th>Cantidad</th>
            <th>Precio Neto</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchaseOrder->pchDetailPurchaseOrders as $index => $detail)
            <tr>
                <td><strong>{{ $index + 1 }}</strong></td>
                <td><strong>{{ $detail->provider_product_code }}</strong></strong></td>
                <td><strong>{{ $detail->whProduct->name }}</strong></strong></td>
                <td><strong>{{ $detail->quantity }}</strong></td>
                <td><strong>$ @format_dec($detail->net_price)</strong></td>
                <td><strong>$ @format_int($detail->net_total)</strong></td>
            </tr>
        @endforeach
    </tbody>
</table>
