<?php

namespace App\Support\Enum\Task;
use App\Support\Enum\ForFactory;
use App\Support\Enum\ForRoute;

enum TaskStatus: string {
    use ForFactory, ForRoute;
    case awaiting = 'awaiting';
    case in_progress = 'in_progress';
    case completed = 'completed';

}
