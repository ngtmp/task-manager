<?php

namespace App\Support\DTO\v1\User;

use App\Models\User;
use App\Support\DTO\BaseDTO;
use Illuminate\Foundation\Http\FormRequest;

readonly class UserDTO extends BaseDTO {
    private function __construct(
        public int|null $id = null,
        public string|null $name = null,
        public string|null $email = null,
        public string|null $status = null,
    )
    {

    }

    public static function fromArray(array $data): UserDTO
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['status'] ?? null,
        );
    }

    public static function fromRequest(FormRequest $formRequest): UserDTO
    {
        return new self(
            $formRequest->validated('id'),
            $formRequest->validated('name'),
            $formRequest->validated('email'),
            $formRequest->validated('status'),
        );
    }

    public static function fromModel(User $model): UserDTO
    {
        return new self(
            $model->id,
            $model->name,
            $model->email,
            $model->status,
        );

    }

}
