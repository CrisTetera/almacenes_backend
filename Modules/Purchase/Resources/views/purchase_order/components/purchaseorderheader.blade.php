<style>
    .container {
        border: 3px solid red;
        color: red;
        text-align: center;
        transform: translate(0, -16px);
        font-size: 14px;
    }
</style>

<div class='container'>
    <p><strong>R.U.T.: {{ $company->formattedRut() }}</strong></p>
    <p><strong>ORDEN DE COMPRA</strong></p>
    <p><strong>N° {{ $purchaseOrder->formattedNumber() }}</strong><p>
</div>
