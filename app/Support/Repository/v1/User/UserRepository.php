<?php

namespace App\Support\Repository\v1\User;

use App\Models\User;
use App\Support\DTO\v1\User\UserDTO;
use App\Support\Repository\ModelRepository;

class UserRepository extends ModelRepository {

    protected $model = User::class;
    protected $dto = UserDTO::class;

}
