<style>
    /* Table details CSS*/
    table.table-observation {
        width: 100%;
        border-collapse: collapse;
        transform: translate(0, -16px);
        margin-top: 16px;
    }
    table.table-observation thead tr:nth-child(1) {
        background-color: #0074D9;
        color: white;
    }
    table.table-observation thead tr:nth-child(2) {
        background-color: #DDDDDD;
        color: #1e3799;
    }
    table.table-observation th, table.table-observation td {
        border: 1px dashed #0074D9;
        padding: 0px 6px 0px 6px; /* top, right, bottom, left */
        font-size: 12px;
    }
    table.table-observation td  {
        height: 70px;
        padding-top: 4px;
    }
</style>

<table class='table-observation'>
    <thead>
        <tr><th colspan='6'>OBSERVACIONES</th></tr>
    </thead>
    <tbody>
        <tr>
            <td colspan='6' valign='top'>{{ $purchaseOrder->observation ? $purchaseOrder->observation : 'Sin Observaciones.' }}</td>
        </tr>
    </tbody>
</table>
