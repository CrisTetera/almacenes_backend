<style>
    .wrapper {
        width: 100%;
        display: table;
    }
    .logo {
        display:table-cell;
        width: 20%;
        vertical-align: middle;
    }
    .company {
        display:table-cell;
        width: 50%;
        font-size: 13px;
        transform: translate(0, -16px);
    }
    .purchaseorderheader {
        display:table-cell;
        width: 30%;
    }
    .logo > img {
        transform: translate(0, -16px);
    }
</style>

<div class='wrapper'>
    <!-- Logo -->
    <div class='logo'>
        <!-- TODO: Modificar IMAGEN AL DE LA BASE DE DATOS -->
        <img src='http://www.agroplastic.cl/padmin_pla/plugin/kcfinder/upload/images/logoARJPG_(Medium).jpg'
             width="128px">
    </div>
    <!-- Data -->
    <div class='company'>
        <p><strong>{{$company->business_name}}</strong></p>
        <p><strong>{{$company->commercial_business}}</strong></p>
        <p><strong>{{$company->address}}</strong></p>
    </div>
    <!-- PO Header -->
    <div class='purchaseorderheader'>
        @component('purchase::purchase_order.components.purchaseorderheader', [
            'company' => $company,
            'purchaseOrder' => $purchaseOrder
        ])
        @endcomponent
    </div>
</div>

<hr>
