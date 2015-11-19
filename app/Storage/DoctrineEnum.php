<?php

namespace App\Storage;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use MabeEnum\Enum;

abstract class DoctrineEnum extends StringType
{
    /**
     * @return Enum
     */
    abstract public function getClass();

    final public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        $class = $this->getClass();
        return $class::get($value);
    }
}