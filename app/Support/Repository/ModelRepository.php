<?php

namespace App\Support\Repository;

use App\Support\DTO\BaseDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ModelRepository implements Repository {

    protected $model = Model::class;
    protected $dto = BaseDTO::class;

    public function __construct()
    {
    }

    public function find($id): Model
    {
        return $this->model::findOrFail($id);
    }

    public function store($dto): Model
    {
        $model = new $this->model((array)$dto);
        $model->save();
        return $model;
    }

    public function update(array $data, string $method): Model
    {
        $model = $this->find($data['id']);
        switch ($method) {
            case 'PATCH':
                $model->fill($data);
                break;
            default:
                $dto = $this->dto::fromArray($data);
                $model->fill((array)$dto);
        }
        $model->save();
        return $model;
    }

    public function destroy($id)
    {
        $model = $this->find($id);
        $model->delete();
    }

}
