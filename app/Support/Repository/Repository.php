<?php

namespace App\Support\Repository;

use App\Support\DTO\BaseDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface Repository {

    public function store(BaseDTO $dto): Model;

    public function update(array $data, string $method): Model;

    public function destroy($id);

    public function find($id): Model;

}
