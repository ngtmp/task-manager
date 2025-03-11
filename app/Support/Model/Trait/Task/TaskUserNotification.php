<?php

namespace App\Support\Model\Trait\Task;

use App\Support\Enum\Task\TaskStatus;

trait TaskUserNotification {

    protected static function bootTaskUserNotification()
    {
        static::updated(function($model) {
            if ( $model->wasChanged('status') && TaskStatus::awaiting->value != $model->status )
            {
                $model->notify(new \App\Notifications\Task\TaskStatusChanged($model));
            }
        });
    }

}
