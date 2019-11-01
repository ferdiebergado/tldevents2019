<?php

namespace Tests\Feature;

use App\Event;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class EventControllerTest extends TestCase
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
            $response = $this->post('/events', $value);

            $response->assertSessionHasErrors();
        }
    }

    public function testStore()
    {
        $event = [
            'title' => 'sample event title',
            'started_at' => '2019-12-3',
            'ended_at' => '2019-12-6',
            'is_active' => true
        ];

        $response = $this->post('/events', $event);

        $this->assertDatabaseHas('events', $event);
        $response->assertRedirect('/events/' . $event->id);
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
        $this->assertEquals(session()->get('success'), __('messages.success'));
    }

    public function testUpdate()
    {
        $event = factory(Event::class)->create();

        $event->title = 'updated event';

        $response = $this->put('/events/' . $event->id, $event->toArray());

        // $this->assertDatabaseHas('events', ['id' => $event->id, 'title' => $event->title]);
        $response->assertRedirect('/events/' . $event->id);
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('info');
        $this->assertEquals(session()->get('info'), __('messages.updated'));
    }

    public function dataSet()
    {
        return [
            [
                'title' => null,
                'started_at' => null,
                'ended_at' => null
            ],
            [
                'title' => 'valid title',
                'started_at' => 'stringdate',
                'ended_at' => 123
            ]
        ];
    }
}