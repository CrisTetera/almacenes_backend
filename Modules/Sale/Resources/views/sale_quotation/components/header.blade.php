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
        font-size: smaller;
        transform: translate(0, -16px);
    }
    .quotationheader {
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
    <!-- Cotización Header -->
    <div class='quotationheader'>
        @component('sale::sale_quotation.components.quotationheader', [
            'company' => $company,
            'saleQuotation' => $saleQuotation
        ])
        @endcomponent
    </div>
</div>

<hr>
