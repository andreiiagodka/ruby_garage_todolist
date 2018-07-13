<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;

class ProjectController extends Controller
{
  public function index()
  {
    $user_id = Auth::id();
    $projects = User::find($user_id)->projects;
    return view('projects.index', compact('projects'));
  }

  public function create()
  {
    $contents = view('projects.create-modal')->render();
    return response()->json(['contents' => $contents]);
  }

  public function store(Request $request)
  {
    $id = Auth::id();
    $project = new Project;
    $project->name = $request->name;
    $project->user_id = $id;
    $project->save();

    $contents = view('projects.project', compact('project'))->render();
    return response()->json(['contents' => $contents]);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $project = Project::find($id);
    $contents = view('projects.edit-modal', compact('project'))->render();
    return response()->json(['contents' => $contents]);
  }

  public function update(Request $request, $id)
  {
    $project = Project::find($id);
    $project->name = $request->name;
    $project->update();
  }

  public function destroy($id)
  {
    $project = Project::find($id);
    $project->delete();
  }
}
