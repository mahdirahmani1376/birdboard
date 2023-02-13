<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(Project $project): bool
    {
        dd(auth()->user()->isNot($project->owner));
        if (auth()->user()->isNot($project->owner)){
            abort(403);
        }

        return true;

    }
}
