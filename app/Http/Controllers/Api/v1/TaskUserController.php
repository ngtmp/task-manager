<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Task\TaskUserAddRequest;
use App\Http\Requests\v1\Task\TaskUserRemoveRequest;
use App\Http\Resources\v1\Task\TaskResource;
use App\Support\DTO\v1\Task\TaskUserDTO;
use App\Support\Repository\v1\Task\TaskUserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TaskUserController extends Controller
{
    public function add(TaskUserAddRequest $taskUserAddRequest, TaskUserRepository $repository): Response|TaskResource
    {
        $dto = TaskUserDTO::fromRequest($taskUserAddRequest);
        $task = $repository->add($dto);
        return new TaskResource($task->load($this->load()));
    }

    public function remove(TaskUserRemoveRequest $taskUserRemoveRequest, TaskUserRepository $repository): Response|TaskResource
    {
        $dto = TaskUserDTO::fromRequest($taskUserRemoveRequest);
        $task = $repository->remove($dto);
        return new TaskResource($task->load($this->load()));
    }

}
