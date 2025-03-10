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

    public function store(Request $request): Model
    {
        $dto = $this->dto::fromRequest($request);
        $model = new $this->model((array)$dto);
        $model->save();
        return $model;
    }

    public function update(Request $request): Model
    {
        $model = $this->find($request->id);
        switch ($request->getMethod()) {
            case 'PATCH':
                $model->fill($request->validated());
                break;
            default:
                $dto = $this->dto::fromRequest($request);
                $model->fill((array)$dto);
        }
        $model->save();
        return $model;
    }

    public function destroy(Request $request)
    {
        $model = $this->find($request->id);
        $model->delete();
    }

}
