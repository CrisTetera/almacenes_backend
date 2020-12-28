<style>
    .date {
        text-align: right;
        transform: translate(0, -16px);
        font-size: 13px;
    }
    /* Table customer CSS */
    table.table-provider {
        width: 100%;
        border: 1px dashed #0074D9;
        border-collapse: collapse;
        margin-bottom: 2px;
        transform: translate(0, -24px);
    }
    table.table-provider td, table.table-provider th {
        padding: 0px 2px 0px 8px; /* top, right, bottom, left*/
        font-size: 13px;
    }
    table.table-provider tr td:first-child, table.table-provider tr th:first-child {
        border-right: 1px dashed #0074D9;
    }
    table.table-provider tr:first-child td {
        padding-top: 8px;
    }
    table.table-provider tr:last-child td {
        padding-bottom: 8px;
    }
    table.table-provider th {
        width: 50%;
        padding: 4px;
    }
</style>

<div>
    <p class='date'>{{ $today }}</p>
    <!-- Table Provider & Requester -->
    <div class='table-container'>
        <table class='table-provider'>
            <thead>
                <tr>
                    <th colspan="2">SOLICITANTE</th>
                    <th colspan="2">PROVEEDOR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"><strong>CONDICIÓN DE PAGO: </strong> {{$purchaseOrder->pchPaymentCondition->type}}.</td>
                    <td colspan="2"><strong>R.U.T.: </strong>{{ $pchProvider->formattedRut() }}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>ENTREGAR EN: </strong>{{$purchaseOrder->whWarehouse->address}}</td>
                    <td colspan="2"><strong>SEÑOR (ES): </strong>{{$pchProvider->business_name}}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>COMUNA: </strong>{{$purchaseOrder->whWarehouse->gBranchOffice->gCommune->name}}</td>
                    <td colspan="2"><strong>DIRECCIÓN: </strong>{{$branchOffice->address}}, {{$branchOffice->gCommune->name}}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>TELÉFONO: </strong>{{$purchaseOrder->whWarehouse->gBranchOffice->phone ? $purchaseOrder->whWarehouse->gBranchOffice->phone : 'Sin teléfono.'}}</td>
                    <td colspan="2"><strong>TELÉFONO: </strong>{{$branchOffice->phone ? $branchOffice->phone : 'Sin teléfono.'}}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>EMAIL: </strong>{{$purchaseOrder->whWarehouse->gBranchOffice->email ? $purchaseOrder->whWarehouse->gBranchOffice->email : 'Sin email.'}}</td>
                    <td colspan="2"><strong>EMAIL: </strong>{{$branchOffice->email ? $branchOffice->email : 'Sin email.'}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
