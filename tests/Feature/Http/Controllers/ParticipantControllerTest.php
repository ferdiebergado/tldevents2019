<?php

namespace Tests\Feature\Http\Controllers;

use App\Event;
use App\Participant;
use Illuminate\Support\Arr;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ParticipantControllerTest extends AbstractTestCase
{
    use WithFaker;

    /** @var \App\Participant */
    protected $participant;

    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();
        $this->participant = factory(Participant::class)->create();
    }

    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get(route('participants.index'))
            ->assertStatus(200)
            ->assertSeeText('List of participants.');
    }

    /**
     * Test index method with search query.
     *
     * @return void
     */
    public function testIndexWithSearch()
    {
        $data = [
            'last_name' => 'Bartolome',
            'email' => 'bartolome@test.com'
        ];

        factory(Participant::class, 5)->create();
        factory(Participant::class)->create($data);

        $this->json('GET', route('participants.index'), ['search' => implode(', ', $data)])
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonPath('data.0.last_name', $data['last_name'])
            ->assertJsonPath('data.0.email', $data['email']);
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->get(route('participants.create'))
            ->assertStatus(200)
            ->assertSee('Create a participant.');
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStore()
    {
        $participant = factory(Participant::class)->make();

        $response = $this->post(route('participants.store'), $participant->toArray())
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        $this->assertEquals(session()->get('success'), __('messages.success'));

        $this->assertDatabaseHas('participants', Arr::only($participant->toArray(), ['last_name', 'first_name', 'mi', 'sex']));

        $this->followRedirects($response)
            ->assertSuccessful()
            ->assertSeeText('View a participant info.')
            ->assertSee($participant['last_name']);
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get(route('participants.edit', ['participant' => $this->participant->id]))
            ->assertSuccessful()
            ->assertSeeText('Edit a participant.')
            ->assertSee($this->participant->last_name);
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShow()
    {
        $this->get(route('participants.show', ['participant' => $this->participant->id]))
            ->assertSuccessful()
            ->assertSeeText('View a participant info.')
            ->assertSee($this->participant->last_name);
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->participant->mobile = '09998887654';
        $response = $this->put(route('participants.update', ['participant' => $this->participant->id]), $this->participant->toArray())
            ->assertSessionHasNoErrors()
            ->assertSessionHas('info')
            ->assertRedirect(route('participants.show', ['participant' => $this->participant->id]));
        $this->assertDatabaseHas('participants', Arr::except($this->participant->toArray(), ['mobile', 'email']));
        $this->assertEquals(session()->get('info'), __('messages.updated'));
        $this->followRedirects($response)
            ->assertSeeText('View a participant info.');
    }

    /**
     * Test search method.
     *
     * @return void
     */
    public function testSearch()
    {
        $this->get(route('participants.search'))
            ->assertSuccessful()
            ->assertSeeText('Search Participants');
    }

    public function testShowAddToEventForm()
    {
        $this->get(route('participants.show_add_to_event_form', ['participant' => $this->participant->id]))
            ->assertSuccessful()
            ->assertSeeText('Addtoevent a participant.')
            ->assertSee($this->participant->last_name);
    }

    public function testAddToEvent()
    {
        $participant = factory(Participant::class)->create();
        $data = array_merge($participant->toArray(), ['participant_role_id' => 1]);
        $this->post(route('participants.add_to_event', ['participant' => $participant->id]), $data)
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect(route('participants.show', ['participant' => $participant->id]));
        $this->assertDatabaseHas('transactions', ['participant_id' => $participant->id, 'event_id' => $this->activeEvent->id, 'participant_role_id' => 1]);
    }
}
