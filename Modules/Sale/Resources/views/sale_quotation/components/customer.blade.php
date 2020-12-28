<style>
    .date {
        text-align: right;
        transform: translate(0, -16px);
    }
    /* Table customer CSS */
    table.table-customer {
        width: 480px;
        border: 1px dashed #0074D9;
        border-collapse: collapse;
        margin-bottom: 2px;
        transform: translate(0, -24px);
    }
    table.table-customer td {
        padding: 0px 2px 0px 8px; /* top, right, bottom, left*/
        font-size: small;
    }
    table.table-customer tr:first-child td {
        padding-top: 8px;
    }
    table.table-customer tr:last-child td {
        padding-bottom: 8px;
    }
</style>

<div>
    <p class='date'>{{ $today }}</p>
    <table class='table-customer'>
        <thead></thead>
        <tbody>
            <tr>
                <td><strong>R.U.T.</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $slCustomer->formattedRut() }}</td>
            </tr>
            <tr>
                <td><strong>SEÑOR (ES)</strong></td>
                <td><strong>:</strong></td>
                <td>{{$slCustomer->business_name}}</td>
            </tr>
            <tr>
                <td><strong>GIRO</strong></td>
                <td><strong>:</strong></td>
                <td>{{$slCustomer->getTruncatedCoreBusiness()}}</td>
            </tr>
            <tr>
                <td><strong>DIRECCIÓN</strong></td>
                <td><strong>:</strong></td>
            <td>{{$branchOffice->address}}, {{$branchOffice->gCommune->name}}</td>
            </tr>
        </tbody>
    </table>
</div>
