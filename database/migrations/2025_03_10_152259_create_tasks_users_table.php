<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks_users', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Task::class)->index();
            $table->foreignIdFor(\App\Models\User::class)->index();
            $table->unique(['user_id', 'task_id'], 'users_tasks_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_users');
    }
};
