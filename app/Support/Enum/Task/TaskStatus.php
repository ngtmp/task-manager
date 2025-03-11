<?php

namespace App\Support\Enum\Task;
use App\Support\Enum\ForFactory;
use App\Support\Enum\ForRoute;

enum TaskStatus: string {
    use ForFactory, ForRoute;
    case awaiting = 'awaiting';
    case in_progress = 'in_progress';
    case completed = 'completed';

    public static function ru($name)
    {
        $ru = [
            'awaiting' => 'К выполнению',
            'in_progress' => 'В работе',
            'completed' => 'Выполнена',
        ];
        return $ru[$name];
    }

}
