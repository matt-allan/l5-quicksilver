<?php

namespace App\Storage;

use MabeEnum\Enum;
use Quicksilver\Domain\Delivery\Status;

class StatusEnum extends DoctrineEnum
{
    /**
     * @return Enum
     */
    public function getClass()
    {
        return Status::class;
    }
}