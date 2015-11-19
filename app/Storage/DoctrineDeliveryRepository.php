<?php

namespace App\Storage;

use Quicksilver\Domain\Delivery;
use Doctrine\ORM\EntityRepository;

class DoctrineDeliveryRepository extends EntityRepository implements Delivery\Repository
{
    /**
     * @param Delivery $delivery
     */
    public function save(Delivery $delivery)
    {
        $this->_em->persist($delivery);
        $this->_em->flush();
    }
}