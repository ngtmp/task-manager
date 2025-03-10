<?php

namespace App\Http\Resources\v1\Task;

use App\Http\Resources\Resource;
use App\Http\Resources\v1\User\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'users' => new UserCollection($this->users),
        ];
    }

}
