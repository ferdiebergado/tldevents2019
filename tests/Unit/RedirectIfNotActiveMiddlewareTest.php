<?php

namespace Tests\Unit;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\RedirectIfNotActive;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RedirectIfNotActiveMiddlewareTest extends TestCase
{
    /**
     * Test inactive users are redirected
     * @test
     * @return void
     */
    public function testInactiveUserIsRedirected()
    {
        $user = factory(User::class)->make(['is_active' => false]);

        $this->actingAs($user);

        $request = Request::create('/home');

        $middleware = new RedirectIfNotActive();

        $response = $middleware->handle($request, function () { });

        $this->assertEquals($response->getStatusCode(), 302);
        $this->assertTrue(session()->has('error'));
        $this->assertEquals(session()->get('error'), __('messages.inactive'));
    }

    /**
     * Test active users are not redirected
     * @test
     * @return void
     */
    public function testActiveUserIsNotRedirected()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user);

        $request = Request::create('/home');

        $middleware = new RedirectIfNotActive();

        $response = $middleware->handle($request, function () { });

        $this->assertEquals($response, null);
    }
}
