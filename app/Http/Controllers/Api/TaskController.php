<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->select('id', 'user_id', 'title', 'description', 'created_at')->paginate(10);
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();

        $task = $this->taskService->createTask($data);
        return response()->json([
            'success' => true,
            'message' => 'Task created successfully.',
            'task' => $task
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();

        $task->update($data);

        return response()->json([
            'success' => true,
            'message' => "Task updated successfully."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized! You can delete only your own task.'
            ], 403);
        }

        $task->delete();
        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.'
        ]);
    }
}
