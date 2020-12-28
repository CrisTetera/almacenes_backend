<style>
    html {
        padding: 0px;
        margin-left: 28px;
        margin-right: 28px;
        margin-top: 40px;
    }
</style>

@extends('sale::layouts.master')

@section('title', $fileName)

@section('content')

    <!-- Header -->
    @component('sale::sale_quotation.components.header', [
        'company' => $company,
        'saleQuotation' => $saleQuotation
    ])
    @endcomponent

    <!-- Customer Details -->
    @component('sale::sale_quotation.components.customer', [
        'today' => $today,
        'slCustomer' => $saleQuotation->slCustomer,
        'branchOffice' => $saleQuotation->slCustomerBranchOffices
    ])
    @endcomponent

    <!-- Details -->
    @component('sale::sale_quotation.components.detail', ['saleQuotation' => $saleQuotation])
    @endcomponent

    <!-- Totals -->
    @component('sale::sale_quotation.components.total', ['saleQuotation' => $saleQuotation])
    @endcomponent

@stop
