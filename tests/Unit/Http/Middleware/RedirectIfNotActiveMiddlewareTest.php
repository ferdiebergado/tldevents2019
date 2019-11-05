<?php

namespace Tests\Unit\Http\Middleware;

use App\User;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\RedirectIfNotActive;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RedirectIfNotActiveMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test inactive users are redirected.
     * 
     * @return void
     */
    public function testInactiveUserIsRedirected()
    {
        $user = factory(User::class)->create(['is_active' => false]);

        $this->actingAs($user);

        $request = Request::create('/home');

        $middleware = new RedirectIfNotActive();

        $response = $middleware->handle($request, function () { });

        $this->assertEquals($response->getStatusCode(), 302);
        $this->assertTrue(session()->has('error'));
        $this->assertEquals(session()->get('error'), __('messages.inactive'));
    }

    /**
     * Test active users are not redirected.
     * 
     * @return void
     */
    public function testActiveUserIsNotRedirected()
    {
        $user = factory(User::class)->create(['is_active' => true]);

        $this->actingAs($user);

        $request = Request::create('/home');

        $middleware = new RedirectIfNotActive();

        $response = $middleware->handle($request, function () { });

        $this->assertEquals($response, null);
    }
}
