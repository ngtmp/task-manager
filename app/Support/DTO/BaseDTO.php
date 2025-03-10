<?php

namespace App\Support\DTO;

readonly abstract class BaseDTO {


    public function __serialize(): array
    {
        return get_object_vars( $this );
    }
}
