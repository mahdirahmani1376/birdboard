<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProjectTasksController extends Controller
{
    public function store(Project $project, Request $request)
    {
        if (auth()->user()->isNot($project->owner)){
            abort(403);
        }

        $data = $request->validate(['body'=>'required|string']);

        $project->addTask($data['body']);

        return redirect(route('projects.show',$project->id));

    }

    public function update(Project $project,Task $task, Request $request)
    {
        if (auth()->user()->isNot($project->owner)){
            abort(403);
        }

        $data = $request->all();
        $task->update([
            'body' => $data['body'],
            'completed' => $data['completed'],
        ]);

        return Response::redirectToRoute('projects.show',$project);
    }
}
