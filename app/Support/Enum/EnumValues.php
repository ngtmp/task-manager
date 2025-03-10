<?php

namespace App\Support\Enum;

trait EnumValues {

    public static function values()
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

}
