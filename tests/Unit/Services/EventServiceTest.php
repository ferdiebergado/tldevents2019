<?php

namespace Tests\Unit\Services;

use App\Event;
use App\Http\Requests\EventRequest;
use Tests\AbstractTestCase;
use App\Services\EventService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;

class EventServiceTest extends AbstractTestCase
{
    use WithFaker;

    /** @var \App\Services\EventService */
    private $service;

    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app()->make(EventService::class);
    }

    /**
     * Test fetchAll() returns a collection of Events sorted by 'created_at'.
     *
     * @return void
     */
    public function testFetchall()
    {
        factory(Event::class, 5)->create();

        $latest = $this->service->fetchAll();

        $this->assertInstanceOf(Collection::class, $latest);
        $this->assertCount(6, $latest);
    }

    /**
     * Test save() method returns a new Event with 'is_active' = false.
     *
     * @return void
     */
    public function testSaveWithStoreTaskWithoutIsActive()
    {
        $event = $this->doSave(false);

        $this->assertFalse($event->is_active);
    }

    /**
     * Test save() method returns a new Event with 'is_active' = true.
     *
     * @return void
     */
    public function testSaveWithStoreTaskWithIsActive()
    {
        $event = $this->doSave(true);

        $this->assertTrue($event->is_active);
    }

    /**
     * Test update() method returns an Event with 'is_active' = false.
     *
     * @return void
     */
    public function testSaveWithUpdateTaskWithoutIsActive()
    {
        $updated = $this->doUpdate(false);

        $this->assertFalse($updated->is_active);
    }

    /**
     * Test update() method returns an Event with 'is_active' = true.
     *
     * @return void
     */
    public function testSaveWithUpdateTaskWithIsActive()
    {
        $updated = $this->doUpdate(true);

        $this->assertTrue($updated->is_active);
    }

    /**
     * Test save() method returns a new Model with the specified attributes.
     *
     * @param boolean $isActive
     * @return \App\Event
     */
    private function doSave(bool $isActive)
    {
        $data = [
            'title' => $this->faker->text,
            'started_at' => now()->toDateString(),
            'ended_at' => now()->addDays(2)->toDateString(),
            'type' => 'W',
            'grouping' => 'R'
        ];

        $task = 'store';

        $eventRequest = $this->mock(EventRequest::class, function ($mock) use ($data, $isActive) {
            $mock->shouldReceive('validated')->once()->andReturn($data);
            $mock->shouldReceive('has')->once()->andReturn($isActive);
        });

        $event = $this->service->save($eventRequest, $task);

        $this->assertDatabaseHas('events', $data);

        $this->assertInstanceOf(Event::class, $event);

        $this->assertArrayContains($data, $event->toArray());

        return $event;
    }

    /**
     * Test updated() method updates a Model with the specified attributes.
     *
     * @param boolean $isActive
     * @return \App\Event
     */
    private function doUpdate(bool $isActive)
    {
        $event = factory(Event::class)->create();

        $data = [
            'started_at' => now()->toDateString(),
            'ended_at' => now()->addDays(2)->toDateString(),
            'type' => 'W',
            'grouping' => 'R'
        ];

        $task = 'update';

        $eventRequest = $this->mock(EventRequest::class, function ($mock) use ($data, $isActive) {
            $mock->shouldReceive('validated')->once()->andReturn($data);
            $mock->shouldReceive('has')->once()->andReturn($isActive);
        });

        $updatedData = array_merge(['id' => $event->id], $data);

        $updated = $this->service->save($eventRequest, $task, $event->id);

        $this->assertDatabaseHas('events', $updatedData);

        $this->assertInstanceOf(Event::class, $updated);

        $this->assertArrayContains($updatedData, $updated->toArray());

        return $updated;
    }
}
