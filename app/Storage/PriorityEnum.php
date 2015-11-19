<?php

namespace App\Storage;

use MabeEnum\Enum;
use Quicksilver\Domain\Delivery\Priority;

class PriorityEnum extends DoctrineEnum
{
    /**
     * @return Enum
     */
    public function getClass()
    {
        return Priority::class;
    }
}