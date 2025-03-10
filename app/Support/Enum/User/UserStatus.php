<?php

namespace App\Support\Enum\User;
use App\Support\Enum\ForFactory;
use App\Support\Enum\ForRoute;

enum UserStatus: string {
    use ForFactory, ForRoute;
    case at_work = 'at_work';
    case on_vacation = 'on_vacation';

}
