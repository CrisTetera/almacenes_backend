<?php

namespace Modules\Warehouse\Services\WhOrderer;

use Modules\Warehouse\Http\Requests\WhOrderer\CreateOrdererRequest;
use Modules\Warehouse\Entities\WhOrderer;
use Modules\Warehouse\Entities\WhDetailOrderer;
use Modules\Warehouse\Http\Requests\WhOrderer\EditOrdererRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dotenv\Exception\ValidationException;
use App\Helpers\Transform;

class OrdererService
{

    /**
     * Store a new Orderer.
     *
     * $request->details structure:
     *       'details.*.wh_product_id',
     *       'details.*.provider_product_code',
     *       'details.*.quantity',
     *       'details.*.brand',
     *       'details.*.description',
     *
     * @param CreateOrdererRequest $request
     * @return integer
     */
    public function store(CreateOrdererRequest $request) : int
    {
        $orderer = new WhOrderer();
        $ordererData = $request->only( $orderer->getFillable() );
        $orderer->fill($ordererData)->save();
        $this->saveDetails($orderer, $request->details);
        return $orderer->id;
    }

    public function update(int $idWhOrderer, EditOrdererRequest $request) : void
    {
        $orderer = $this->checkOrderer($idWhOrderer);
        $this->checkIfCanBeModified($orderer);

        $ordererData = $request->only( $orderer->getFillable() );
        $orderer->fill($ordererData)->save();

        $this->deleteDetails($orderer);
        $this->saveDetails($orderer, $request->details);
    }

    public function delete(int $idWhOrderer) : void
    {
        $orderer = $this->checkOrderer($idWhOrderer);
        $this->checkIfCanBeModified($orderer);

        $this->deleteOrderer($orderer);
        $this->deleteDetails($orderer);
    }

    private function saveDetails(WhOrderer $orderer, array $details)
    {
        foreach($details as $detail)
        {
            $detail = Transform::transformNullsToEmptyString($detail);
            $detailOrderer = new WhDetailOrderer();
            $detailOrderer->fill($detail);
            $detailOrderer->wh_orderer_id = $orderer->id;
            $detailOrderer->save();
        };
    }

    private function deleteOrderer(WhOrderer $orderer)
    {
        $orderer->update(['flag_delete' => true]);
    }

    private function deleteDetails(WhOrderer $orderer)
    {
        WhDetailOrderer::whereWhOrdererId($orderer->id)->whereFlagDelete(false)->update(['flag_delete' => true]);
    }

    private function checkOrderer(int $idWhOrderer)
    {
        $orderer = WhOrderer::whereId($idWhOrderer)->whereFlagDelete(false)->first();
        if (!$orderer)
        {
            throw new ModelNotFoundException("Pedido ($idWhOrderer) no encontrado");
        }
        return $orderer;
    }

    private function checkIfCanBeModified(WhOrderer $orderer)
    {
        if (!$this->canBeModified($orderer))
        {
            throw new ValidationException("La solicitud de abastecimiento no puede ser modificada. Ya existe una OC asociada.");
        }
    }

    private function canBeModified(WhOrderer $orderer)
    {
        return $orderer->pchPurchaseOrders->count() === 0;
    }


}
