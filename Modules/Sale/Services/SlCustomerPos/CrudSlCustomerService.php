<?php

namespace Modules\Sale\Services\SlCustomerPos;

use Modules\Sale\Http\Requests\SlCustomerPos\CreateSlCustomerRequest;
use Modules\Sale\Entities\SlCustomerPos;
use Dotenv\Exception\ValidationException;
use Modules\Sale\Http\Requests\SlCustomerPos\EditSlCustomerRequest;

class CrudSlCustomerService
{
    public function __construct()
    {
        
    }

    public function store(CreateSlCustomerRequest $request) {
        
        /*if($this->checkRut($request->rut)){
            $customer = new SlCustomerPos();
            $this->setCustomerParams($customer, $request);
            $this->saveCustomer($customer);
        }*/
        
        $this->checkRut($request->rut);
        $customer = new SlCustomerPos();
        $this->setCustomerParams($customer, $request);
        $this->saveCustomer($customer);
        
        return [
            'customer_id' => $customer->id,
        ];
    }

    public function update($idSlCustomer, EditSlCustomerRequest $request)
    {
        $customer = $this->checkCustomer($idSlCustomer);
        $this->checkRutWhenUpdating($request->rut, $idSlCustomer);
        $this->setCustomerParams($customer, $request);
        $customer->save();

        return $customer->id;
    }

    public function delete($idSlCustomer)
    {
        $customer = $this->checkCustomer($idSlCustomer);
        $customer->flag_delete = true;
        $customer->save();

        return $customer->id;
    }

    /**
     * Check rut
     *
     * @param string $rut
     * @return void
     */
    private function checkRut($rut) {
        $customer = SlCustomerPos::where('rut', $rut)->where('flag_delete', false)->first();
        if ($customer) {
            throw new ValidationException("El rut ya ha sido tomado");
        }
    }

    /**
     * Check rut when updating
     *
     * @param string $rut
     * @param integer $idSlCustomer
     * @return void
     */
    private function checkRutWhenUpdating($rut, $idSlCustomer) {
        $customer = SlCustomerPos::where('rut', $rut)->where('flag_delete', false)->where('id', '!=', $idSlCustomer)->first();
        if ($customer) {
            throw new ValidationException("El rut ya ha sido tomado");
        }
    }

    /**
     * Set customer params
     *
     * @param SlCustomerPos $customer
     * @param FormRequest $request
     * @return void
     */
    public function setCustomerParams(SlCustomerPos &$customer, $request) {
        $customer->rut = $request['rut'];
        $customer->business_name = $request['business_name'];
        $customer->alias_name = $request['alias_name'];
        $customer->commercial_business = $request['commercial_business'];
        $customer->address = $request['address'];
        $customer->phone_number = $request['phone_number'];
        $customer->email= $request['email'];
        $customer->g_commune_id = $request['g_commune_id'];
        $customer->is_company = $request['is_company'];
    }

    /**
     * Stores a new customer in database
     *
     * @parma SlCustomer $customer
     * @return SlCustomerPos
     */
    public function saveCustomer($customer) 
    {
        $customer->save();
    }

    /**
     * Check if customer exists in database
     *
     * @param integer $idSlCustomer
     * @return SlCustomerPos
     */
    private function checkCustomer($idSlCustomer)
    {
        $customer = SlCustomerPos::where('id', $idSlCustomer)->where('flag_delete', false)->first();
        if (!$customer) {
            throw new ValidationException('El cliente no existe');
        }
        return $customer;
    }

}
