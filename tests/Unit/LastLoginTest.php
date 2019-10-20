<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LastLoginTest extends TestCase
{
    /**
     * Test if last_login_at field of user is updated on login.
     *
     * @return void
     */
    public function testAuthenticated()
    {
        $user = User::first();
        Auth::attempt(['email' => $user->email, 'password' => $user->password]);
        $this->assertNotNull($user->last_login_at);
    }
}
