<style>
    /* Table totals CSS */
    div.table-total-container {
        position: relative;
        display: block;
        height: 76px;
        width: 100%;
    }
    table.table-total {
        position: absolute;
        width: 240px;
        right: 0px;
        border: 1px dashed #0074D9;
        border-collapse: collapse;
    }
    table.table-total td {
        padding: 2px 6px 2px 6px; /* top, right, bottom, left */
        font-size: small;
    }
    table.table-total tr td:nth-child(1){
        color: #1e3799;
    }
    table.table-total tr td:nth-child(1), table.table-total tr td:nth-child(3){
        text-align: right;
    }
    table.table-total tr:last-child td{
        background-color: #0074D9;
        color: white;
    }
</style>

<div class='table-total-container'>
    <table class='table-total'>
        <thead></thead>
        <tbody>
            <tr>
                <td>MONTO NETO</td>
                <td>$</td>
                <td>@format_int($purchaseOrder->net_subtotal)</td>
            </tr>
            <tr>
                <td>IVA 19%</td>
                <td>$</td>
                <td>@format_int($purchaseOrder->iva)</td>
            </tr>
            <tr>
                <td><strong>TOTAL</strong></td>
                <td>$</td>
                <td><strong>@format_int($purchaseOrder->total)</strong></td>
            </tr>
        </tbody>
    </table>
</div>
