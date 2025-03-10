<?php

namespace App\Support\Repository\v1\Task;


use App\Models\Task;
use App\Support\DTO\v1\Task\TaskUserDTO;
use Illuminate\Http\Request;

class TaskUserRepository {
    protected $model = Task::class;

    public function __construct()
    {
    }

    public function find($id): Task
    {
        return $this->model::findOrFail($id);
    }

    public function add(Request $request): Task
    {
        $dto = TaskUserDTO::fromRequest($request);
        $task = $this->find($dto->task_id);
        $task->users()->syncWithoutDetaching([$dto->user_id]);
        return $task;
    }

    public function remove(Request $request): Task
    {
        $dto = TaskUserDTO::fromRequest($request);
        $task = $this->find($dto->task_id);
        $task->users()->detach($dto->user_id);
        return $task;
    }

}
