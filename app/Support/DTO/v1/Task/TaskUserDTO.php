<?php

namespace App\Support\DTO\v1\Task;

use App\Support\DTO\BaseDTO;
use Illuminate\Foundation\Http\FormRequest;

readonly class TaskUserDTO extends BaseDTO {
    private function __construct(
        public int $task_id,
        public int $user_id,
    )
    {

    }

    public static function fromArray(array $data): TaskUserDTO
    {
        return new self(
            $data['task_id'] ?? null,
            $data['user_id'] ?? null,
        );
    }

    public static function fromRequest(FormRequest $formRequest): TaskUserDTO
    {
        return new self(
            $formRequest->validated('task_id'),
            $formRequest->validated('user_id'),
        );
    }

}
