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

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    return Project::find($id);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $project = Project::find($id);
    $project->delete();
    return redirect('/projects');
  }
}
