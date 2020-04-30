<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use Carbon\Carbon;

class TaskController extends Controller
{
    
    use ValidatesRequests;
    
    public function index(Task $task)
    {
        return response($task->all(), 200);
    }
    
    public function get(int $taskId)
    {
        return response(Task::findOrFail($taskId), 200);
    }
    
    public function create(CreateTask $request)
    {
        //$request->validate();
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->assigned_to = $request->input('assigned_to');
        $task->assigned_by = $request->input('assigned_by');
        $task->when = Carbon::createFromFormat('m/d/Y H:i', $request->input('when'));
        $task->duration = $request->input('duration');
        $task->done = false;
        $task->save();
        return response($task, 201);
    }
    
    public function update(Request $request, int $taskId)
    {
        $task = Task::findOrFail($taskId);
        $changed = false;
        if ($request->has('title') && !empty($request->input('title'))) {
            $task->title = $request->input('title');
            $changed = true;
        }
        if ($request->has('description') && !empty($request->input('description'))) {
            $task->description = $request->input('description');
            $changed = true;
        }
        if ($request->has('assigned_to') && !empty($request->input('assigned_to'))) {
            $task->assigned_to = $request->input('assigned_to');
            $changed = true;
        }
        if ($request->has('assigned_by') && !empty($request->input('assigned_by'))) {
            $task->assigned_by = $request->input('assigned_by');
            $changed = true;
        }
        if ($request->has('when') && !empty($request->input('when'))) {
            $task->when = Carbon::createFromFormat('m/d/Y H:i', $request->input('when'));
            $changed = true;
        }
        if ($request->has('duration') && !empty($request->input('duration'))) {
            $task->duration = $request->input('duration');
            $changed = true;
        }
        if ($request->has('done') && !empty($request->input('done'))) {
            $task->done = (boolean) $request->input('done');
            $changed = true;
        }
        if ($changed) {
            $task->save();
            $responseCode = 200;
        } else {
            $responseCode = 304;
        }
        return response($task, $responseCode);
    }
    
    public function delete(int $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();
        return response($task->all(), 200);
    }
    
    public function indexView()
    {
        $tasks = Task::all();
        return view('tasks', ['tasks' => $tasks]);
    }
}
