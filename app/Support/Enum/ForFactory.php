<?php

namespace App\Support\Enum;

trait ForFactory {
    use EnumValues;
    public static function forFactory()
    {
        $values = self::values();
        $max = count($values)-1;
        return $values[rand(0,$max)];
    }
}
