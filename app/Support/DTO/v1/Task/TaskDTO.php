<?php

namespace App\Support\DTO\v1\Task;

use App\Models\Task;
use App\Support\DTO\BaseDTO;
use Illuminate\Foundation\Http\FormRequest;

readonly class TaskDTO extends BaseDTO {
    private function __construct(
        public int|null $id = null,
        public string|null $title = null,
        public string|null $description = null,
        public string|null $status = null,
    )
    {

    }

    public static function fromArray(array $data): TaskDTO
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['status'] ?? null,
        );
    }

    public static function fromRequest(FormRequest $formRequest): TaskDTO
    {
        return new self(
            $formRequest->validated('id'),
            $formRequest->validated('title'),
            $formRequest->validated('description'),
            $formRequest->validated('status'),
        );
    }

    public static function fromModel(Task $model): TaskDTO
    {
        return new self(
            $model->id,
            $model->title,
            $model->description,
            $model->status,
        );

    }

}
