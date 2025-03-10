<?php

namespace App\Http\Requests\v1\User;

use App\Support\Enum\User\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->route('user')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return match($this->getMethod()) {
            'POST' => $this->store(),
            'PUT' => $this->update(),
            'PATCH' => $this->patch(),
            'DELETE' => $this->destroy(),
            default => $this->show(),
        };
    }

    public function show()
    {
        return [
            'id' => ['required', "exists:users,id"],
        ];
    }

    public function store()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users,email'],
            'status' => ['required', Rule::enum(UserStatus::class)],
        ];
    }

    public function update()
    {
        return [
            'id' => ['required', "exists:users,id"],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', "unique:users,email,{$this->id}"],
            'status' => ['required', Rule::enum(UserStatus::class)],
        ];
    }

    public function patch()
    {
        return [
            'id' => ['required', "exists:users,id"],
            'name' => ['required_without_all:email,status', 'string', 'max:255'],
            'email' => ['required_without_all:name,status', 'string', 'max:255', "unique:users,email,{$this->id}"],
            'status' => ['required_without_all:name,email', Rule::enum(UserStatus::class)],
        ];
    }

    public function destroy()
    {
        return [
            'id' => ['required', "exists:users,id"],
        ];
    }
}
