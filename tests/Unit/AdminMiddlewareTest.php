<?php

namespace Tests\Unit;

use App\Http\Middleware\Admin;
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
    public function testNonAdminUserIsRedirected()
    {
        $user = factory(User::class)->make(['role' => 3]);

        $this->actingAs($user);

        $request = Request::create('/admin/decompose');

        $middleware = new Admin();

        $response = $middleware->handle($request, function () { });

        $this->assertEquals($response->getStatusCode(), 302);
        $this->assertTrue(session()->has('error'));
        $this->assertEquals(session()->get('error'), __('messages.pagenotfound'));
    }

    /**
     * Test active users are not redirected
     * @test
     * @return void
     */
    public function testAdminUserIsNotRedirected()
    {
        $user = factory(User::class)->make(['role' => 1]);

        $this->actingAs($user);

        $request = Request::create('/admin/decompose');

        $middleware = new Admin();

        $response = $middleware->handle($request, function () { });

        $this->assertEquals($response, null);
    }
}
