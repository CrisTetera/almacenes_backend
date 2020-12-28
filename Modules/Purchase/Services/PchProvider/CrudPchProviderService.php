<?php

namespace Modules\Purchase\Services\PchProvider;

use Modules\Purchase\Entities\PchProvider;
use Dotenv\Exception\ValidationException;
use Modules\Purchase\Entities\PchProviderAccount;
use Modules\Purchase\Entities\PchProviderBranchOffices;
use Modules\Purchase\Http\Requests\PchProvider\EditProviderRequest;
use Modules\Purchase\Http\Requests\PchProvider\CreateProviderRequest;

class CrudPchProviderService
{

    /** @var ProviderBranchOfficesService $providerBranchOfficeService */
    private $providerBranchOfficeService;

    public function __construct(ProviderBranchOfficesService $providerBranchOfficeService)
    {
        $this->providerBranchOfficeService = $providerBranchOfficeService;
    }

    public function store(CreateProviderRequest $request) {
        $this->checkRut($request->rut);

        $provider = new PchProvider();
        $provider->fill( $request->only($provider->getFillable()) );
        $this->saveProvider($provider);

        $this->providerBranchOfficeService->handleBranchOffices($provider, $request->branch_offices);

        return [
            'provider_id' => $provider->id,
            'provider_account_id' => $provider->pch_provider_account_id
        ];
    }

    public function update($idPchProvider, EditProviderRequest $request)
    {
        $provider = $this->checkProvider($idPchProvider);
        $this->checkRut($request->rut, [ $idPchProvider ]);
        $provider->fill( $request->only($provider->getFillable()) );
        $provider->save();

        $this->providerBranchOfficeService->handleUpdateBranchOffices($provider, $request->branch_offices);

        return $provider->id;
    }

    public function delete($idPchProvider)
    {
        $provider = $this->checkProvider($idPchProvider);
        $provider->flag_delete = true;
        $provider->save();
        // Delete provider account.
        PchProviderAccount::where('pch_provider_id', $provider->id)->update(['flag_delete' => true]);
        // Delete Branch Offices
        PchProviderBranchOffices::where('pch_provider_id', $provider->id)->update(['flag_delete' => true]);

        return $provider->id;
    }

    /**
     * Check rut
     *
     * @param string $rut
     * @return void
     */
    private function checkRut($rut, $excludeIds = []) {
        $provider = PchProvider::whereRut($rut)->whereFlagDelete(false)->whereNotIn('id', $excludeIds)->first();
        if ($provider) {
            throw new ValidationException("El rut ya ha sido tomado");
        }
    }

    /**
     * Generates a new Provider Account
     *
     * @param integer $providerId
     * @return PchProviderAccount
     */
    public function newProviderAccount($providerId) {
        return new PchProviderAccount([
            'pch_provider_id' => $providerId,
            'debt_to_pay' => 0,
            'flag_delete' => false
        ]);
    }

    /**
     * Stores a new provider in database
     *
     * @parma PchProvider $provider
     * @return PchProvider
     */
    public function saveProvider($provider) {
        $provider->save();

        $providerAccount = $this->newProviderAccount($provider->id);
        $providerAccount->save();

        $provider->pch_provider_account_id = $providerAccount->id;
        $provider->save();
    }

    /**
     * Check if provider exists in database
     *
     * @param integer $idPchProvider
     * @return PchProvider
     */
    private function checkProvider($idPchProvider)
    {
        $provider = PchProvider::whereId($idPchProvider)->whereFlagDelete(false)->first();
        if (!$provider) {
            throw new ValidationException("El proveedor ($idPchProvider) no existe.");
        }
        return $provider;
    }

}
