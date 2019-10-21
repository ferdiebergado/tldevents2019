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
            $response = $this->post('/admin/events', $value);

            $response->assertSessionHasErrors();
        }
    }

    public function testStore()
    {
        $event = [
            'title' => 'sample event title',
            'started_at' => '2019/12/3',
            'ended_at' => '2019/12/6'
        ];

        $response = $this->post('/admin/events', $event);

        $this->assertDatabaseHas('events', $event);
        $response->assertRedirect('/admin/events');
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
        $this->assertEquals(session()->get('success'), __('messages.success'));
    }

    public function testUpdate()
    {
        $event = factory(Event::class)->create();

        $event->title = 'updated event';

        // $updates = [
        //     'title' => 'updated event',
        //     'started_at' => '2020/1/12',
        //     'ended_at' => '2020/1/13'
        // ];

        $response = $this->put('/admin/events/' . $event->id, $event->toArray());

        $this->assertDatabaseHas('events', ['id' => $event->id, 'title' => $event->title]);
        $response->assertRedirect('/admin/events');
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
