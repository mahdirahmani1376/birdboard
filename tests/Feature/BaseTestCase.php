<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class BaseTestCase extends TestCase
{
    public $user;

    public function setUp(): void
    {
        parent::setUp();

    }

    public function signIn()
    {
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }
}
