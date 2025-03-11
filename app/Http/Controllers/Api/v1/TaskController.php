<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Task\TaskRequest;
use App\Http\Resources\v1\Task\TaskCollection;
use App\Http\Resources\v1\Task\TaskResource;
use App\Models\Task;
use App\Support\DTO\v1\Task\TaskDTO;
use App\Support\Repository\v1\Task\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(Request $request): Response|AnonymousResourceCollection|TaskCollection
    {
        return new TaskCollection(Task::with($this->load())->paginate($request->paginate ?? $this->paginate));
    }

    public function show(TaskRequest $taskRequest, TaskRepository $repository): Response|TaskResource
    {
        $task = $repository->find($taskRequest->id);
        return new TaskResource($task->load($this->load()));
    }

    public function store(TaskRequest $taskRequest, TaskRepository $repository): Response|TaskResource
    {
        $dto = TaskDTO::fromRequest($taskRequest);
        $task = $repository->store($dto);
        return new TaskResource($task->load($this->load()));
    }

    public function update(TaskRequest $taskRequest, TaskRepository $repository): Response|TaskResource
    {
        $task = $repository->update($taskRequest->validated(), $taskRequest->getMethod());
        return new TaskResource($task->load($this->load()));
    }

    public function destroy(TaskRequest $taskRequest, TaskRepository $repository): Response|TaskResource
    {
        $task = $repository->destroy($taskRequest->id);
        return new Response([], 204);
    }
}
