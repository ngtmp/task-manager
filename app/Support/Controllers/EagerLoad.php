<?php

namespace App\Support\Controllers;

trait EagerLoad {

    protected function prepareLoad(string $class, string $function): array
    {
        return match($class) {
            \App\Http\Controllers\Api\v1\TaskController::class,
            \App\Http\Controllers\Api\v1\TaskUserController::class => [
                'users',
            ],
            default => [],
        };
    }

    public function load($additional = []): array
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        return array_merge($this->prepareLoad($trace[1]['class'], $trace[1]['function']), $additional);
    }


}


