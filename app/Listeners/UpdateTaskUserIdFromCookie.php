<?php

namespace App\Listeners;

use App\Models\Task;
use App\Events\UserAuthenticated;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateTaskUserIdFromCookie
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserAuthenticated $event): void
    {
        
        $taskTokens = getTaskCookie();

        

        foreach ($taskTokens as $token) {
            $task = Task::where('task_token', $token)->first();
            $task->user_id = auth()->id();
            $task->update();
        }

        Cookie::forget('task_token');
    }
}
