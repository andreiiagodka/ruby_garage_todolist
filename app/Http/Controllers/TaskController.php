<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
  use App\Models\Task;
  use App\Models\Project;
  use App\Http\Requests\UpdateNameRequest;
  use App\Http\Requests\Task\StoreTaskRequest;
  use App\Http\Requests\Task\StatusTaskRequest;
  use App\Http\Requests\Task\UpdateDeadlineTaskRequest;
  use Carbon\Carbon;

  class TaskController extends Controller
  {
    public function __construct() {
      $this->middleware('auth');
    }

    public function store(StoreTaskRequest $request)
    {
      $project = Project::find($request->project_id);
      if (Auth::id() != $project->user_id) return;
      $task = Task::create([
        'name' => $request->name,
        'position' => Task::maxPositionByProjectId($request->project_id),
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

    public function update(UpdateNameRequest $request, $id)
    {
      $task = Task::find($id);
      Task::validateUniqueName($task, $request);
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
      return $this->positionUpDown($id, $request->prev_task_id);
    }

    public function positionDown(Request $request, $id) {
      return $this->positionUpDown($id, $request->next_task_id);
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

    protected function positionUpDown($current_task_id, $request_task_id) {
      $current_task = Task::find($current_task_id);
      $request_task = Task::find($request_task_id);

      $current_task_position = $current_task->position;
      $current_task->update(['position' => $request_task->position]);
      $request_task->update(['position' => $current_task_position]);

      return $this->renderTaskPositions($current_task);
    }

    protected function renderTaskPositions($task) {
      return response()->json([
        'task_position' => $task->position,
        'min_position' => $task->minPosition($task),
        'max_position' => $task->maxPosition($task)
      ]);
    }
  }
