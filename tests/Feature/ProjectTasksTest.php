<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends BaseTestCase
{
    use RefreshDatabase;


    /** @test */
    function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $response = $this->post(route('tasks.store',$project),['body' => 'test']);
        $response->assertStatus(403);
        $this->assertDatabaseMissing('tasks',['body' => 'test']);
    }

    /** @test */
    function a_task_can_be_updated()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $project->addTask('test task');

        app(ProjectFactory::class)->ownedBy($this->user)->withTasks(3)->create();

        $task = $project->tasks->first;
        $response = $this->patch(route('tasks.update',['project' => $project,'task' => $task->toArray()]),[
            'body' => 'changed',
            'completed' => true,
        ]);

        $this->assertDatabaseHas('tasks',[
            'body' => 'changed',
            'completed' => true,
        ]);
    }

    /** @test */
    function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = Project::factory()->create(Project::factory()->raw());


        $project->addTask('test task');

        $task = $project->tasks->first;
        $response = $this->patch(route('tasks.update',['project' => $project,'task' => $task->toArray()]),[
            'body' => 'changed',
            'completed' => true,
        ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('tasks',[
            'body' => 'changed',
            'completed' => true,
        ]);
    }

}
