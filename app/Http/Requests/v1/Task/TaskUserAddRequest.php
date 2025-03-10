<?php

namespace App\Http\Requests\v1\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskUserAddRequest extends FormRequest
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
        $this->merge(['task_id' => $this->route('task'), 'user_id' => $this->route('user')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'task_id' => ['required', 'exists:tasks,id'],
            'user_id' => ['required', 'exists:users,id,status,at_work', "unique:tasks_users,user_id,NULL,,task_id,{$this->task_id}"],
        ];
    }
}
