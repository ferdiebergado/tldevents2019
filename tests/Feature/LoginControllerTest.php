<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testAuthenticated()
    {
        $user = factory(User::class)->create(['is_active' => true]);
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password', '_token' => csrf_token()]);
        $response->assertRedirect('/home');
    }

    public function testLoggedOut()
    {
        $user = factory(User::class)->make();
        auth()->attempt(['email' => $user->email, 'password' => $user->password]);
        $response = $this->actingAs($user)->post('/logout', ['_token' => csrf_token()]);
        $response->assertRedirect('/');
        $response->assertHeader('Pragma', 'no-cache');
        $response->assertHeader('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        $response->assertHeader('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store, private');
    }
}
