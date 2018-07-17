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
      $task = new Task;
      $task->name = $request->name;
      $task->project_id = $request->project_id;
      $task->save();

      $contents = view('tasks.task', compact('task'))->render();
      return response()->json(['contents' => $contents]);
    }

    public function show($id)
    {

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
  }
