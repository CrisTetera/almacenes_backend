<?php

namespace Modules\Purchase\Services\PchProvider;

use Modules\Purchase\Entities\PchProvider;
use Modules\Purchase\Entities\PchProviderBranchOffices;
use App\Helpers\Transform;

class ProviderBranchOfficesService
{
    public function handleBranchOffices(PchProvider $provider, $branchOffices = [])
    {
        foreach($branchOffices as $branchOffice)
        {
            $providerBranchOffices = new PchProviderBranchOffices();
            $providerBranchOffices->fill( Transform::transformNullsToEmptyString($branchOffice) );
            $providerBranchOffices->pch_provider_id = $provider->id;
            $providerBranchOffices->save();
        }
    }

    public function handleUpdateBranchOffices(PchProvider $provider, $branchOffices = [])
    {
        $foundedIds = [];
        foreach($branchOffices as $branchOffice)
        {
            // Si existe por comuna/dirección actualiza, si no inserta.
            $providerBranchOffices = $this->getProviderBranchOffice($provider, $branchOffice);
            if (!$providerBranchOffices)
            {
                $providerBranchOffices = new PchProviderBranchOffices();
                $providerBranchOffices->pch_provider_id = $provider->id;
            }
            $providerBranchOffices->fill( Transform::transformNullsToEmptyString($branchOffice) );
            $providerBranchOffices->save();
            array_push($foundedIds, $providerBranchOffices->id);
        }
        // Elimina los IDS inexistentes
        $this->removeNotFoundProviderBranchOffices($provider, $foundedIds);
    }

    private function getProviderBranchOffice(PchProvider $provider, $branchOffice)
    {
        return PchProviderBranchOffices::where('pch_provider_id', $provider->id)
                                        ->where('g_commune_id', $branchOffice['g_commune_id'])
                                        ->where('address', $branchOffice['address'])
                                        ->where('flag_delete', false)
                                        ->first();
    }

    private function removeNotFoundProviderBranchOffices(PchProvider $provider, $foundedIds = [])
    {
        PchProviderBranchOffices::where('pch_provider_id', $provider->id)
                                ->whereNotIn('id', $foundedIds)
                                ->update(['flag_delete' => true]);
    }

}
