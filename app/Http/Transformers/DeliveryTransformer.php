<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Quicksilver\Domain\Delivery;

class DeliveryTransformer extends TransformerAbstract
{
    /**
     * @param Delivery $delivery
     * @return array
     */
    public function transform(Delivery $delivery)
    {
        return [
            'id'        => $delivery->getId(),
            'status'    => $delivery->getStatus()->getValue(),
            'priority'  => $delivery->getPriority()->getValue(),
            'requester' => $delivery->getRequester()->getId(),
            'signature' => $delivery->getSignature(),
            'pickup'    => [
                'name'      => $delivery->getPickup()->getName(),
                'street'    => $delivery->getPickup()->getStreet(),
                'city'      => $delivery->getPickup()->getCity(),
                'state'     => $delivery->getPickup()->getState(),
                'post_code' => $delivery->getPickup()->getPostCode(),
            ],
            'dropoff'   => [
                'name'      => $delivery->getDestination()->getName(),
                'street'    => $delivery->getDestination()->getStreet(),
                'city'      => $delivery->getDestination()->getCity(),
                'state'     => $delivery->getDestination()->getState(),
                'post_code' => $delivery->getDestination()->getPostCode(),
            ],
        ];
    }
}