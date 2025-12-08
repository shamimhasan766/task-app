<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function createTask(array $data): Task
    {
        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        return $task;
    }
}
