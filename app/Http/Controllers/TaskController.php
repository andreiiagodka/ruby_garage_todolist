<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
  use App\Models\Task;
  use App\Http\Requests\Task\StoreTaskRequest;
  use App\Http\Requests\Task\UpdateTaskRequest;
  use App\Http\Requests\Task\StatusTaskRequest;
  use App\Http\Requests\Task\UpdateDeadlineTaskRequest;
  use Carbon\Carbon;

  class TaskController extends Controller
  {
    public function __construct() {
      $this->middleware('auth', ['only' => 'store', 'update', 'destroy',
      'status', 'positionUp', 'positionDown', 'deadlineUpdate']);
    }

    public function store(StoreTaskRequest $request)
    {
      $task = Task::create([
        'name' => $request->name,
        'position' => Task::maxPositionByProjectId($request->project_id) + 1,
        'deadline' => Carbon::now()->addDay(),
        'project_id' => $request->project_id
      ]);

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

    public function update(UpdateTaskRequest $request, $id)
    {
      $task = Task::find($id);
      $task->update(['name' => $request->name]);
    }

    public function destroy($id)
    {
      $task = Task::find($id);
      $task->delete();
      return $this->renderTaskPositions($task);
    }

    public function status(StatusTaskRequest $request, $id) {
      $task = Task::find($id);
      $task->update(['status' => intval($request->status == 0)]);
      return $task->status;
    }

    public function positionUp(Request $request, $id) {
      $current_task = Task::find($id);
      $prev_task = Task::find($request->prev_task_id);

      $current_task_position = $current_task->position;
      $current_task->update(['position' => $prev_task->position]);
      $prev_task->update(['position' => $current_task_position]);

      return $this->renderTaskPositions($current_task);
    }

    public function positionDown(Request $request, $id) {
      $current_task = Task::find($id);
      $next_task = Task::find($request->next_task_id);

      $current_task_position = $current_task->position;
      $current_task->update(['position' => $next_task->position]);
      $next_task->update(['position' => $current_task_position]);

      return $this->renderTaskPositions($current_task);
    }

    public function deadlineEdit($id) {
      $task = Task::find($id);
      $contents = view('tasks.edit-deadline', compact('task'))->render();
      return response()->json(['contents' => $contents]);
    }

    public function deadlineUpdate(UpdateDeadlineTaskRequest $request, $id) {
      $task = Task::find($id);
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
