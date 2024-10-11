<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TaskResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate(2);
        // Change this line to use the TaskResource:
        return TaskResource::collection($tasks);
    }
    public function store(StoreTaskRequest $request)
    {
        $task = $request->user()->tasks()->create($request->validated());
        return new TaskResource($task);
    }
    public function show(Task $task)
    {
        return new TaskResource($task);
    }
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return new TaskResource($task);
    }
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
