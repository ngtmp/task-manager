<?php

namespace App\Support\Enum\Task;
use App\Support\Enum\ForFactory;

enum TaskStatus: string {
    use ForFactory;
    case awaiting = 'awaiting';
    case in_progress = 'in_progress';
    case completed = 'completed';

}
