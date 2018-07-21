<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use App\Models\Task;

  class TaskController extends Controller
  {
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
      $project_id = $request->project_id;
      $max_position = Task::where('project_id', $project_id)->pluck('position')->max();

      $task = new Task;
      $task->name = $request->name;
      $task->position = $max_position + 1;
      $task->project_id = $project_id;
      $task->save();

      $contents = view('tasks.task', compact('task'))->render();
      return response()->json(['contents' => $contents]);
    }

    public function show($id)
    {
      $task = Task::find($id);
      $contents = view('tasks.show-modal', compact('task'))->render();
      return response()->json(['contents' => $contents]);
    }

    public function edit($id)
    {
      $task = Task::find($id);
      $contents = view('tasks.edit-modal', compact('task'))->render();
      return response()->json(['contents' => $contents]);
    }

    public function update(Request $request, $id)
    {
      $task = Task::find($id);
      $task->name = $request->name;
      $task->update();
    }

    public function destroy($id)
    {
      $task = Task::find($id);
      $task->delete();
    }

    public function status(Request $request, $id) {
      $task = Task::find($id);
      ($request->status == 0) ? $task->status = 1 : $task->status = 0;
      $task->update();
      return $task->status;
    }

    public function positionUp(Request $request, $id) {
      $current_task = Task::find($id);
      $prev_task = Task::find($request->prev_task_id);

      $current_task_position = $current_task->position;

      $current_task->update(['position' => $prev_task->position]);
      $prev_task->update(['position' => $current_task_position]);

      $min_position = $current_task->project->tasks->pluck('position')->min();
      $max_position = $current_task->project->tasks->pluck('position')->max();

      return response()->json(['min_position' => $min_position, 'max_position' => $max_position]);
    }

    public function positionDown(Request $request, $id) {
      $current_task = Task::find($id);
      $next_task = Task::find($request->next_task_id);

      $current_task_position = $current_task->position;

      $current_task->update(['position' => $next_task->position]);
      $next_task->update(['position' => $current_task_position]);

      $min_position = $current_task->project->tasks->pluck('position')->min();
      $max_position = $current_task->project->tasks->pluck('position')->max();
      
      return response()->json(['min_position' => $min_position, 'max_position' => $max_position]);
    }
  }
