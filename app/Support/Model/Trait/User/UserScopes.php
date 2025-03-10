<?php

namespace App\Support\Model\Trait\User;

use App\Support\Enum\User\UserStatus;
use Illuminate\Database\Eloquent\Builder;

trait UserScopes {

    public function scopeAtWork(Builder $query)
    {
        $query->where('users.status', UserStatus::at_work->value);
    }

}
