<?php

namespace Tests\Feature;

use App\Models\Project;
use Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ManageProjectsTest extends BaseTestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function test_a_user_can_create_a_project()
    {
        $this->signIn();

        $attributes = $this->user->projects()->create(Project::factory()->raw());

        $response = $this->post(route('projects.store'), $attributes->toArray());
        $this->assertDatabaseHas('projects', [
            'title' => $attributes['title'],
            'description' => $attributes['description'],
        ]);

        $response->assertRedirectToRoute('projects.index');

        $responseGet = $this->get(route('projects.show',));
    }

    /** @test */
    public function test_a_user_can_see_projects()
    {
        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function test_validation_errors()
    {
        $data = [];

        $response = $this->post(route('projects.store'), $data);

        $response->assertSessionHasErrors(['title', 'description']);
    }

    /** @test */
    public function test_a_user_can_see_his_projects()
    {
        $project = Project::factory()->create(['owner_id' => $this->user->id]);

        $response = $this->get(route('projects.show', $project->id));

        $response->assertViewHas([
            'project' => $project,
        ]);

        $response->assertSee([
            $project->text, $project->description,
        ]);
    }

    /** @test */
    public function a_project_requires_an_owner()
    {
        Auth::logout();
        $attributes = Project::factory()->raw();
        $response = $this->post(route('projects.store'), $attributes);

        $response->assertRedirectToRoute('login');
    }
}
