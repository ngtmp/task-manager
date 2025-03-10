<?php

namespace App\Support\Repository\v1\Task;

use App\Models\Task;
use App\Support\DTO\v1\Task\TaskDTO;
use App\Support\Repository\ModelRepository;

class TaskRepository extends ModelRepository {

    protected $model = Task::class;
    protected $dto = TaskDTO::class;


    public function group()
    {
        return $this->model::orderBy('tasks.status');
    }

    public function status($status)
    {
        return $this->model::where('tasks.status', $status);
    }

}
