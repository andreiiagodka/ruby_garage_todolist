<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Project;
use App\Http\Requests\UpdateNameRequest;
use App\Http\Requests\Project\StoreProjectRequest;

class ProjectController extends Controller
{
  public function __construct() {
    $this->middleware('auth', ['only' => 'store', 'update', 'destroy']);
  }

  public function index()
  {
    $projects = User::find(Auth::id())->projects;
    return view('projects.index', compact('projects'));
  }

  public function create()
  {
    $contents = view('projects.create-modal')->render();
    return response()->json(['contents' => $contents]);
  }

  public function store(StoreProjectRequest $request)
  {
    $project = Project::create([
      'name' => $request->name,
      'user_id' => Auth::id()
    ]);

    $contents = view('projects.project', compact('project'))->render();
    return response()->json(['contents' => $contents]);
  }

  public function show($id)
  {
    return $this->handleShowEditResponse($id, 'projects.show-modal');
  }

  public function edit($id)
  {
    return $this->handleShowEditResponse($id, 'projects.edit-modal');
  }

  public function update(UpdateNameRequest $request, $id)
  {
    $project = Project::find($id);
    Project::validateUniqueName($project, $request);
    $project->update(['name' => $request->name]);
  }

  public function destroy($id)
  {
    $project = Project::find($id);
    $project->delete();
  }

  protected function handleShowEditResponse($id, $view) {
    $project = Project::find($id);
    $contents = view($view, compact('project'))->render();
    return response()->json(['contents' => $contents]);
  }
}
