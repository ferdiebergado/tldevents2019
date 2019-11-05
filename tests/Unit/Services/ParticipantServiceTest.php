<?php

namespace Tests\Unit\Services;

use App\Participant;
use Tests\AbstractTestCase;

class ParticipantServiceTest extends AbstractTestCase
{
    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app()->make('App\Services\ParticipantService');
    }

    /**
     * Test fetchAll method with search.
     *
     * @return void
     */
    public function testFetchAllWithSearch()
    {
        $data = [
            'last_name' => 'Bartolome',
            'mobile' => '99998887766'
        ];

        factory(Participant::class, 5)->create();

        factory(Participant::class)->create($data);

        $search = implode(', ', $data);

        $results = $this->service->fetchAll($search);

        $this->assertEquals(1, count($results));

        foreach ($data as $key => $value) {
            $this->assertContains($value, $results[0]->toArray());
        }
    }

    public function testUpdate()
    {
        $participant = factory(Participant::class)->create();
        $updates = [
            'email' => 'abc@123.com'
        ];

        $updated = $this->service->update($participant->id, $updates, false);

        $this->assertContains($updates['email'], $updated->toArray());
    }

    public function testAddToEvent()
    {
        $participant = factory(Participant::class)->create();
        $updates = [
            'email' => 'abc@123.com',
            'participant_role_id' => 1
        ];

        $updated = $this->service->addToEvent($participant->id, $updates);

        $this->assertDatabaseHas('transactions', ['participant_id' => $participant->id, 'event_id' => $this->activeEvent->id, 'participant_role_id' => $updates['participant_role_id']]);

        $this->assertContains($updates['email'], $updated->toArray());
    }
}
