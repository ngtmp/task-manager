<?php

namespace App\Jobs\Task;

use App\Models\Task;
use App\Models\User;
use App\Support\DTO\v1\Task\TaskUserDTO;
use App\Support\Repository\v1\Task\TaskUserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TaskAutoAssign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $id)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(TaskUserRepository $repository): void
    {
        $task = Task::findOrFail($this->id);
        if (!$task->users()->count() && $user_id = User::atWork()->get()->random()->id) {
            $dto = TaskUserDTO::fromArray(['task_id' => $task->id, 'user_id' => $user_id]);
            $repository->add($dto);
        }
    }
}
