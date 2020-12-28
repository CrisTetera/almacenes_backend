<?php

namespace Modules\Sale\Services\SlCustomer;

use Modules\Sale\Http\Requests\SlCustomer\CreateSlCustomerRequest;
use Modules\Sale\Entities\SlCustomer;
use Modules\Sale\Entities\SlCustomerAccount;
use Dotenv\Exception\ValidationException;
use Modules\Sale\Http\Requests\SlCustomer\EditSlCustomerRequest;
use Modules\Sale\Entities\SlCustomerPresetsDiscount;
use Modules\Sale\Entities\SlCustomerBranchOffices;

class CrudSlCustomerService
{
    /** @var CustomerBranchOfficesService $customerBranchOfficesService */
    private $customerBranchOfficesService;

    public function __construct(CustomerBranchOfficesService $customerBranchOfficesService)
    {
        $this->customerBranchOfficesService = $customerBranchOfficesService;
    }

    public function store(CreateSlCustomerRequest $request) {
        $this->checkRut($request->rut);

        $customer = new SlCustomer();
        $this->setCustomerParams($customer, $request);
        $this->saveCustomer($customer);

        $this->customerBranchOfficesService->handleBranchOffices($customer, $request->branch_offices);

        $request->discount = $request->discount ? $request->discount : 0;
        $this->storeDiscount($customer, $request->discount);

        return [
            'customer_id' => $customer->id,
            'customer_account_id' => $customer->sl_customer_account_id
        ];
    }

    public function update($idSlCustomer, EditSlCustomerRequest $request)
    {
        $customer = $this->checkCustomer($idSlCustomer);
        $this->checkRutWhenUpdating($request->rut, $idSlCustomer);
        $this->setCustomerParams($customer, $request);
        $customer->save();

        $this->customerBranchOfficesService->handleUpdateBranchOffices($customer, $request->branch_offices);

        $request->discount = $request->discount ? $request->discount : 0;
        $this->storeDiscount($customer, $request->discount);
        return $customer->id;
    }

    public function delete($idSlCustomer)
    {
        $customer = $this->checkCustomer($idSlCustomer);
        $customer->flag_delete = true;
        $customer->save();
        // Delete customer account.
        SlCustomerAccount::where('sl_customer_id', $customer->id)->update(['flag_delete' => true]);
        // Delete Preset Discount
        SlCustomerPresetsDiscount::where('sl_customer_id', $customer->id)->update(['flag_delete' => true]);
        // Delete Branch Offices
        SlCustomerBranchOffices::where('sl_customer_id', $customer->id)->update(['flag_delete' => true]);

        return $customer->id;
    }

    /**
     * Check rut
     *
     * @param string $rut
     * @return void
     */
    private function checkRut($rut) {
        $customer = SlCustomer::where('rut', $rut)->where('flag_delete', false)->first();
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
        $customer = SlCustomer::where('rut', $rut)->where('flag_delete', false)->where('id', '!=', $idSlCustomer)->first();
        if ($customer) {
            throw new ValidationException("El rut ya ha sido tomado");
        }
    }

    /**
     * Set customer params
     *
     * @param SlCustomer $customer
     * @param FormRequest $request
     * @return void
     */
    public function setCustomerParams(SlCustomer &$customer, $request) {
        $customer->rut = $request['rut'];
        $customer->business_name = $request['business_name'];
        $customer->alias_name = $request['alias_name'];
        $customer->core_business = $request['core_business'];
    }

    /**
     * Generates a new Customer Account
     *
     * @param integer $customerId
     * @return SlCustomerAccount
     */
    public function newCustomerAccount($customerId) {
        return new SlCustomerAccount([
            'sl_customer_id' => $customerId,
            'debt_amount' => 0,
            'flag_delete' => false
        ]);
    }

    /**
     * Stores a new customer in database
     *
     * @parma SlCustomer $customer
     * @return SlCustomer
     */
    public function saveCustomer($customer) {
        $customer->save();

        $customerAccount = $this->newCustomerAccount($customer->id);
        $customerAccount->save();

        $customer->sl_customer_account_id = $customerAccount->id;
        $customer->save();
    }

    /**
     * Store or Update discount
     *
     * @param SlCustomer $customer
     * @param integer $discount
     * @return void
     */
    private function storeDiscount(SlCustomer $customer, $discount) {
        $slCustomerPresetsDiscount = SlCustomerPresetsDiscount::where('sl_customer_id', $customer->id)->where('flag_delete', false)->first();
        if (!$slCustomerPresetsDiscount) {
            $slCustomerPresetsDiscount = new SlCustomerPresetsDiscount();
            $slCustomerPresetsDiscount->sl_customer_id = $customer->id;
            $slCustomerPresetsDiscount->flag_delete = false;
        }
        $slCustomerPresetsDiscount->discount_percentage = $discount;
        $slCustomerPresetsDiscount->save();
    }

    /**
     * Check if customer exists in database
     *
     * @param integer $idSlCustomer
     * @return SlCustomer
     */
    private function checkCustomer($idSlCustomer)
    {
        $customer = SlCustomer::where('id', $idSlCustomer)->where('flag_delete', false)->first();
        if (!$customer) {
            throw new ValidationException('El cliente no existe');
        }
        return $customer;
    }

}
