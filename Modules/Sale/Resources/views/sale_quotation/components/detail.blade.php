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
    table.table-details tbody tr td:nth-child(1), table.table-details tbody tr td:nth-child(3) {
        text-align: center;
    }
    table.table-details tbody tr td:nth-child(n + 4) {
        text-align: right;
    }
</style>

<table class='table-details'>
    <thead>
        <tr><th colspan='6'>DETALLE ÍTEMS</th></tr>
        <tr>
            <th>Código</th>
            <th>Ítem</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Dscto. o Cargo</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($saleQuotation->slDetailSaleQuotations as $detail)
            <tr>
                <td><strong>{{ $detail->whProduct->internal_code }}</strong></strong></td>
                <td><strong>{{ $detail->whProduct->name }}</strong></strong></td>
                <td><strong>{{ $detail->quantity }}</strong></td>
                @if ($saleQuotation->isTicket())
                    <td><strong>$ @format_int($detail->price)</strong></td>
                @else
                    <td><strong>$ @format_dec($detail->net_price)</strong></td>
                @endif

                @if ($detail->getDiscountAmount() === 0)
                    <td><strong>-</strong></td>
                @else
                    <td><strong>- $@format_int($detail->getDiscountAmount())</strong></td>
                @endif


                @if ($saleQuotation->isTicket())
                    <td><strong>$ @format_int($detail->total)</strong></td>
                @else
                    <td><strong>$ @format_int($detail->new_net_subtotal)</strong></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
