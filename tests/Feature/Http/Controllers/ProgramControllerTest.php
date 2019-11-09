<?php

namespace Tests\Feature\Http\Controllers;

use App\Program;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ProgramControllerTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    /**
     * @test
     * @dataProvider dataSet
     *
     * @return void
     */
    public function testStoreWithInvalidData()
    {
        foreach ($this->dataSet() as $value) {
            $response = $this->post('/admin/programs', $value);

            $response->assertSessionHasErrors();
        }
    }

    public function testStore()
    {
        $program = [
            'title' => 'test program 2',
            'key_stage' => 4
        ];

        $response = $this->post('/admin/programs', $program);

        $this->assertDatabaseHas('programs', $program);
        $response->assertRedirect('/admin/programs');
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
        $this->assertEquals(session()->get('success'), __('messages.success'));
    }

    public function testUpdate()
    {
        $updates = [
            'title' => 'updated program',
            'key_stage' => 3
        ];

        $response = $this->put('/admin/programs/1', $updates);

        // $this->assertDatabaseHas('programs', $updates);
        $response->assertRedirect('/admin/programs');
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('info');
        $this->assertEquals(session()->get('info'), __('messages.updated'));
    }

    public function dataSet()
    {
        return [
            [
                'title' => null,
                'key_stage' => null
            ],
            [
                'title' => 'valid title',
                'key_stage' => 'invalid'
            ]
        ];
    }
}
