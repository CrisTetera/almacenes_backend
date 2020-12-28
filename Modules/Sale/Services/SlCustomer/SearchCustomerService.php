<?php

namespace Modules\Sale\Services\SlCustomer;

use Modules\Sale\Entities\SlCustomer;
use Modules\Pos\Services\DTE\Request\GetTaxPayerFromApiOF;
use Modules\General\Entities\GCommune;
use Modules\Sale\Entities\SlCustomerBranchOffices;


class SearchCustomerService
{

    /** @var CrudSlCustomerService $crudSlCustomerService */
    private $crudSlCustomerService;

    public function __construct(CrudSlCustomerService $crudSlCustomerService)
    {
        $this->crudSlCustomerService = $crudSlCustomerService;
    }

    /**
     * Search a customer by rut.
     * steps:
     * 1. Search customer in database, if exists: return it, if not go to step 2
     * 2. Search customer in openfactura, if exists: store it and return it, if not go to step 3
     * 3. Return not found.
     *
     * @param string $rut
     * @return void
     */
    public function searchByRut($rut) {
        $customer = SlCustomer::where('rut', $rut)->where('flag_delete', false)->first();
        if ($customer) return ['customer' => $customer, 'branch_offices' => $customer->getBranchOfficesAttribute()];
        // Looks in Open Factura
        $taxPayerOFService = new GetTaxPayerFromApiOF();
        $customerOF = $taxPayerOFService->getTaxPayer($rut);

        if (!$customerOF) return ['customer' => null, 'branch_offices' => []];

        return $this->newCustomerFromCustomerOF($customerOF);
    }

    /**
     * Generates a new customer from a customer returned by Open Factura
     *
     * @param object $customerOF
     * @return void
     */
    public function newCustomerFromCustomerOF($customerOF) {
        $indexPrincipalActivity = array_search(true, array_column($customerOF->actividades, 'actividadPrincipal'));
        $principalActivity = $indexPrincipalActivity !== false ? $customerOF->actividades[$indexPrincipalActivity]->giro : '';
        $commune = $customerOF->comuna ? GCommune::where('name', 'LIKE', "%$customerOF->comuna%")->first() : null;

        $customer = new SlCustomer();
        $customer->rut = $customerOF->rut;
        $customer->business_name = $customerOF->razonSocial;
        $customer->alias_name = $customerOF->razonSocial;
        $customer->core_business = $principalActivity;
        $this->crudSlCustomerService->saveCustomer($customer);

        $customerBranchOffice = new SlCustomerBranchOffices();
        $customerBranchOffice->sl_customer_id = $customer->id;
        $customerBranchOffice->g_commune_id = $commune ? $commune->id : SlCustomerBranchOffices::DEFAULT_COMMUNE;
        $customerBranchOffice->address = $customerOF->direccion;
        $customerBranchOffice->phone = $customerOF->telefono ? $customerOF->telefono: '';
        $customerBranchOffice->email = $customerOF->email ? $customerOF->email : '';
        $customerBranchOffice->default_branch_office = true;
        $customerBranchOffice->save();

        return ['customer' => $customer, 'branch_offices' => [$customerBranchOffice] ];
    }
}
