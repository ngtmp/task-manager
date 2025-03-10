<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Task\TaskStatusRequest;
use App\Http\Resources\v1\Task\TaskCollection;
use App\Models\Task;
use App\Support\Repository\v1\Task\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskStatusController extends Controller
{
    public function group(Request $request, TaskRepository $repository): Response|TaskCollection
    {
        $task = $repository->group();
        return new TaskCollection($task->with($this->load())->paginate($request->paginate ?? $this->paginate));
    }

    public function status(TaskStatusRequest $taskStatusRequest, TaskRepository $repository): Response|TaskCollection
    {
        $task = $repository->status($taskStatusRequest->status);
        return new TaskCollection($task->with($this->load())->paginate($request->paginate ?? $this->paginate));
    }

}
