<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
  use App\Models\Task;
  use Carbon\Carbon;

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
      $task->deadline = Carbon::now()->addDay();
      $task->project_id = $project_id;
      $task->save();

      $contents = view('tasks.task', compact('task'))->render();
      return response()->json(['contents' => $contents, 'task_position' => $task->position]);
    }

    public function show($id)
    {
      return $this->handleShowEditResponse($id, 'tasks.show-modal');
    }

    public function edit($id)
    {
      return $this->handleShowEditResponse($id, 'tasks.edit-modal');
    }

    public function update(Request $request, $id)
    {
      $task = Task::find($id);
      if (!$task->isAuthorizedUser($task)) return;
      $task->update(['name' => $request->name]);
    }

    public function destroy($id)
    {
      $task = Task::find($id);
      if (!$task->isAuthorizedUser($task)) return;
      $task->delete();
      return $this->renderTaskPositions($task);
    }

    public function status(Request $request, $id) {
      $task = Task::find($id);
      if (!$task->isAuthorizedUser($task)) return;
      $task->status = int_val($request->status == 0);
      $task->update();
      return $task->status;
    }

    public function positionUp(Request $request, $id) {
      $current_task = Task::find($id);
      $prev_task = Task::find($request->prev_task_id);

      if (!$current_task->isAuthorizedUser($current_task)) return;

      $current_task_position = $current_task->position;
      $current_task->update(['position' => $prev_task->position]);
      $prev_task->update(['position' => $current_task_position]);

      return $this->renderTaskPositions($current_task);
    }

    public function positionDown(Request $request, $id) {
      $current_task = Task::find($id);
      $next_task = Task::find($request->next_task_id);

      if (!$current_task->isAuthorizedUser($current_task)) return;

      $current_task_position = $current_task->position;
      $current_task->update(['position' => $next_task->position]);
      $next_task->update(['position' => $current_task_position]);

      return $this->renderTaskPositions($current_task);
    }

    public function deadlineEdit($id) {
      $task = Task::find($id);
      if (!$task->isAuthorizedUser($task)) return;

      $contents = view('tasks.edit-deadline', compact('task'))->render();
      return response()->json(['contents' => $contents]);
    }

    public function deadlineUpdate(Request $request, $id) {
      $task = Task::find($id);
      if (!$task->isAuthorizedUser($task)) return;
      $task->update(['deadline' => $request->deadline]);
    }

    protected function handleShowEditResponse($id, $view) {
      $task = Task::find($id);
      $contents = view($view, compact('task'))->render();
      return response()->json(['contents' => $contents]);
    }

    protected function renderTaskPositions($task) {
      return response()->json([
        'task_position' => $task->position,
        'min_position' => $task->minPosition($task),
        'max_position' => $task->maxPosition($task)
      ]);
    }
  }
