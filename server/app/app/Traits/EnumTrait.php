<?php

namespace app\Traits;

use ReflectionClass;

trait EnumTrait
{
    /**
     * @throws \ReflectionException
     */
    public static function getEnumValues($enumClassName)
    {
        $enumClass = new ReflectionClass($enumClassName);
        return $enumClass->getConstants();
    }
}
