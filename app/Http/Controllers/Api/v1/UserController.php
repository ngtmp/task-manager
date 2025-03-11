<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\User\UserRequest;
use App\Http\Resources\v1\User\UserCollection;
use App\Http\Resources\v1\User\UserResource;
use App\Models\User;
use App\Support\DTO\v1\User\UserDTO;
use App\Support\Repository\v1\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function index(Request $request): Response|AnonymousResourceCollection|UserCollection
    {
        return new UserCollection(User::with($this->load())->paginate($request->paginate ?? $this->paginate));
    }

    public function show(UserRequest $userRequest, UserRepository $repository): Response|UserResource
    {
        $user = $repository->find($userRequest->id);
        return new UserResource($user->load($this->load()));
    }


    public function store(UserRequest $userRequest, UserRepository $repository): Response|UserResource
    {
        $dto = UserDTO::fromRequest($userRequest);
        $user = $repository->store($dto);
        return new UserResource($user->load($this->load()));
    }

    public function update(UserRequest $userRequest, UserRepository $repository): Response|UserResource
    {
        $user = $repository->update($userRequest->validated(), $userRequest->getMethod());
        return new UserResource($user->load($this->load()));
    }

    public function destroy(UserRequest $userRequest, UserRepository $repository): Response|UserResource
    {
        $user = $repository->destroy($userRequest->id);
        return new Response([], 204);
    }
}
