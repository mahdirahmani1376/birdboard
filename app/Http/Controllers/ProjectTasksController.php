<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project, Request $request)
    {
        $data = $request->validate(['body'=>'required|string']);

        $project->addTask($data['body']);

        return redirect(route('projects.show',$project->id));

    }

    public function update(Project $project, Request $request)
    {
        $data = $request->validate(['body'=>'required|string']);

    }
}
