<?php

namespace Tests\Feature\Http\Controllers;

use App\Event;
use Illuminate\Support\Arr;
use Tests\AbstractTestCase;

class EventControllerTest extends AbstractTestCase
{
    /** @var \App\Event */
    private $event;

    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get(route('events.index'))
            ->assertStatus(200)
            ->assertSeeText('List of events.');
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->get(route('events.create'))
            ->assertStatus(200)
            ->assertSee('Create an event.');
    }

    /**
     * @dataProvider dataSet
     *
     * @return void
     */
    public function testStoreWithInvalidData()
    {
        foreach ($this->dataSet() as $value) {
            $this->post(route('events.store'), $value)
                ->assertSessionHasErrors()
                ->assertStatus(302);
        }
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStore()
    {
        $event = factory(Event::class)->make(['is_active' => true]);

        $response = $this->post(route('events.store'), $event->toArray())
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');
        $this->assertEquals(session()->get('success'), __('messages.success'));
        $this->assertDatabaseHas('events', Arr::except($event->toArray(), ['grouping_name', 'type_name', 'duration_date']));

        $this->followRedirects($response)
            ->assertSuccessful()
            ->assertSeeText($event->title);
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get(route('events.edit', ['event' => $this->activeEvent->id]))
            ->assertSuccessful()
            ->assertSeeText('Edit an event.')
            ->assertSee($this->activeEvent->title);
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $event = factory(Event::class)->create();

        $event->title = 'updated event title';

        $this->put(route('events.update', ['event' => $event->id]), $event->toArray())
            ->assertRedirect(route('events.show', ['event' => $event->id]))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('info');
        $this->assertEquals(session()->get('info'), __('messages.updated'));
        $this->assertDatabaseHas('events', Arr::except($event->toArray(), ['grouping_name', 'type_name', 'duration_date']));
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShow()
    {
        $this->get(route('events.show', ['event' => $this->activeEvent->id]))
            ->assertSuccessful()
            ->assertSeeText('View an event.')
            ->assertSee($this->activeEvent->title);
    }

    /**
     * Dataset for the tests.
     *
     * @return void
     */
    public function dataSet()
    {
        return [
            [
                'title' => null,
                'started_at' => null,
                'ended_at' => null,
                'grouping' => null,
                'type' => null
            ],
            [
                'title' => 'valid title',
                'started_at' => 'stringdate',
                'ended_at' => 123,
                'grouping' => 'X',
                'type' => 'Y'
            ]
        ];
    }
}
