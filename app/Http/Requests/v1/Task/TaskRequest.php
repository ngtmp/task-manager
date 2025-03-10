<?php

namespace App\Http\Requests\v1\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        $this->merge(['id' => $this->route('task')]);
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
            'id' => ['required', 'exists:tasks,id'],
        ];
    }

    public function store()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:4096'],
            'status' => ['required', 'in:awaiting,in_progress,completed'],
        ];
    }

    public function update()
    {
        return [
            'id' => ['required', 'exists:tasks,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:4096'],
            'status' => ['required', 'in:awaiting,in_progress,completed'],
        ];
    }

    public function patch()
    {
        return [
            'id' => ['required', "exists:tasks,id"],
            'title' => ['required_without_all:description,status', 'string', 'max:255'],
            'description' => ['required_without_all:title,status', 'string', 'max:4096'],
            'status' => ['required_without_all:title,description', 'in:awaiting,in_progress,completed'],
        ];
    }

    public function destroy()
    {
        return [
            'id' => ['required', "exists:tasks,id"],
        ];
    }
}
