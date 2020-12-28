<style>
    html {
        padding: 0px;
        margin-left: 28px;
        margin-right: 28px;
        margin-top: 40px;
    }
</style>

@extends('purchase::layouts.master')

@section('title', $fileName)

@section('content')

    <!-- Header -->
    @component('purchase::purchase_order.components.header', [
        'company' => $company,
        'purchaseOrder' => $purchaseOrder
    ])
    @endcomponent

    <!-- Provider Details -->
    @component('purchase::purchase_order.components.provider_requester', [
        'today' => $today,
        'purchaseOrder' => $purchaseOrder,
        'pchProvider' => $purchaseOrder->pchProvider,
        'branchOffice' => $purchaseOrder->pchProviderBranchOffices
    ])
    @endcomponent

    <!-- Details -->
    @component('purchase::purchase_order.components.detail', ['purchaseOrder' => $purchaseOrder])
    @endcomponent

    <!-- Totals -->
    @component('purchase::purchase_order.components.total', ['purchaseOrder' => $purchaseOrder])
    @endcomponent

    <!-- Observation -->
    @component('purchase::purchase_order.components.observation', ['purchaseOrder' => $purchaseOrder])
    @endcomponent

    <!-- References -->
    @component('purchase::purchase_order.components.references', ['references' => $references])
    @endcomponent


@stop
