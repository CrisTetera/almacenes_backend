<?php

namespace Modules\Sale\Services\SlCustomerPos;

use Modules\Sale\Entities\SlCustomerPos;
use Modules\Pos\Services\DTE\Request\GetTaxPayerFromApiOF;
use Modules\General\Entities\GCommunePos;


class SearchCustomerService
{
    private const DEFAULT_COMMUNE=27;

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
        $customer = SlCustomerPos::where('rut', $rut)->where('flag_delete', false)->first();
        if ($customer) return ['customer' => $customer];
        // Looks in Open Factura
        $taxPayerOFService = new GetTaxPayerFromApiOF();
        $customerOF = $taxPayerOFService->getTaxPayer($rut);

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
        $commune = $customerOF->comuna ? GCommunePos::where('name', 'LIKE', "%$customerOF->comuna%")->first() : null;

        $customer = new SlCustomerPos();
        $customer->rut = $customerOF->rut;
        $customer->business_name = $customerOF->razonSocial;
        $customer->alias_name = $customerOF->razonSocial;
        $customer->commercial_business = $principalActivity;
        $customer->address = $customerOF->direccion;
        $customer->phone_number = $customerOF->telefono ? $customerOF->telefono: '';
        $customer->email = $customerOF->email ? $customerOF->email : '';
        $customer->g_commune_id = $commune ? $commune->id : self::DEFAULT_COMMUNE;
        $customer->is_company = $customerOF->is_company;
        $this->crudSlCustomerService->saveCustomer($customer);


        return ['customer' => $customer];
    }
}
