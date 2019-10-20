<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgramControllerTest extends TestCase
{
    /**
     * Test program index
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->make(['role' => 1]);

        $response = $this->actingAs($user)->get('/admin/programs');

        $response->assertStatus(200);
    }
}
