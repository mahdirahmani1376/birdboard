<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedtest extends BaseTestCase
{
    use RefreshDatabase;

    /** @test */
    public function does_updating_a_project_records_before_after_activity()
    {
        $this->signIn();
        $project = Project::factory()->create(['description' => 'before']);
        $projectChange = $project->toArray();
        $projectChange['description'] = 'after';

        $response = $this->put(route('projects.update',$project),$projectChange);

        $this->assertDatabaseHas('activities',[
           'changes' => [
               'before' => $project->description,
               'after' => $projectChange['description'],
           ]
        ]);
    }


}
