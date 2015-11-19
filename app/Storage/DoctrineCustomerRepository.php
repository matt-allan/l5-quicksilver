<?php

namespace App\Storage;

use Doctrine\ORM\EntityRepository;
use Quicksilver\Domain\Customer;

class DoctrineCustomerRepository extends EntityRepository implements Customer\Repository
{
    /**
     * @param Customer $customer
     */
    public function save(Customer $customer)
    {
        $this->_em->persist($customer);
        $this->_em->flush();
    }
}