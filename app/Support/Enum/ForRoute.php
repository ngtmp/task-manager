<?php

namespace App\Support\Enum;

trait ForRoute {
    use EnumValues;
    public static function forRoute()
    {
        $values = self::values();
        return join('|', $values);
    }
}
