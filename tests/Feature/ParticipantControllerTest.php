<?php

namespace Tests\Feature;

use App\Participant;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipantControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    private $user;
    private $participant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->user = User::find(1);
        $this->participant = Participant::find(1);
        $this->be($this->user);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/admin/participants');

        $response->assertStatus(200);
        $response->assertSee('List of all participants.');
    }

    public function testCreate()
    {
        $response = $this->get('/admin/participants/create');
        $response->assertStatus(200);
        $response->assertSee('Create a participant.');
    }

    public function testStore()
    {
        $participant = [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'mi' => $this->faker->randomLetter,
            'sex' => $this->faker->randomElement(['M', 'F']),
            'station' => $this->faker->company,
            'mobile' => '09876543210',
            'email' => $this->faker->email
        ];

        $response = $this->post('/admin/participants', $participant);

        $response->assertStatus(302);

        // $this->assertDatabaseHas('participants', $participant);

        $response->assertSessionHasNoErrors();

        $response->assertSessionHas('success');
        $this->assertEquals(session()->get('success'), __('messages.success'));

        $response = $this->followRedirects($response);
        $response->assertSuccessful();
        $response->assertSeeText('View a participant.');
        $response->assertSee($participant['last_name']);
    }

    public function testEdit()
    {
        $response = $this->get('/admin/participants/1/edit');
        $response->assertSuccessful();
        $response->assertSeeText('Edit a participant.');
        $response->assertSee($this->participant->last_name);
    }

    public function testShow()
    {
        $response = $this->get('/admin/participants/1');
        $response->assertSuccessful();
        $response->assertSeeText('View a participant.');
        $response->assertSee($this->participant->last_name);
    }

    public function testUpdate()
    {
        $this->participant->mobile = '09998887654';
        $response = $this->put('/admin/participants/' . $this->participant->id, $this->participant->toArray());
        // $this->assertDatabaseHas('participants', ['id' => $this->participant->id, 'mobile' => ['09998887654']]);
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('info');
        $this->assertEquals(session()->get('info'), __('messages.updated'));
        $response->assertRedirect('/admin/participants/' . $this->participant->id);
        $response = $this->followRedirects($response);
        $response->assertSeeText('View a participant.');
    }
}
