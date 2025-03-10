<?php

namespace App\Support\Model\Trait\Task;

trait TaskAutoAssign {

    protected static function bootTaskAutoAssign()
    {
        $delayInSeconds = 120;
        static::created(function($model) use ($delayInSeconds) {
            \App\Jobs\Task\TaskAutoAssign::dispatch($model->id)->delay($delayInSeconds);
        });
    }

}
