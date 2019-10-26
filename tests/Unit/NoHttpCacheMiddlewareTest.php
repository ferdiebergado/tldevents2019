<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoHttpCacheMiddlewareTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLogout()
    {
        $user = factory(User::class)->make();
        auth()->attempt(['email' => $user->email, 'password' => $user->password]);
        $response = $this->actingAs($user)->post('/logout', ['_token' => csrf_token()]);
        $response->assertRedirect('/');
        $response->assertHeader('Pragma', 'no-cache');
    }
}
