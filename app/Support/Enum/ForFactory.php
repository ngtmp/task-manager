<?php

namespace App\Support\Enum;

trait ForFactory {

    public static function forFactory()
    {
        $values = array_map(fn ($case) => $case->value, self::cases());
        $max = count($values)-1;
        return $values[rand(0,$max)];
    }
}
