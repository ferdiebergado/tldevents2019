<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisteredTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test if user is logged out after registration.
     *
     * @return void
     */
    public function testRegister()
    {
        $response = $this->post('/register', [
            'name' => 'test user',
            'email' => 'user@test.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            '_token' => csrf_token()
        ]);

        $response->assertRedirect('/login');

        // $response->assertStatus(200);
    }
}
