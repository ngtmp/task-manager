<?php

namespace App\Support\Enum\User;
use App\Support\Enum\ForFactory;

enum UserStatus: string {
    use ForFactory;
    case at_work = 'at_work';
    case on_vacation = 'on_vacation';

}
