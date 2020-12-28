<style>
    .container {
        border: 3px solid red;
        color: red;
        text-align: center;
        transform: translate(0, -16px);
    }
</style>

<div class='container'>
    <p><strong>R.U.T.: {{ $company->formattedRut() }}</strong></p>
    <p><strong>COTIZACIÓN {{ $saleQuotation->saleTypeString() }}</strong></p>
    <p><strong>N° {{ $saleQuotation->number }}</strong><p>
</div>
