<?php

namespace Tests\Feature;

use App\Participant;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageParticipantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_participant_list_in_participant_index_page()
    {
        $participant = factory(Participant::class)->create();

        $this->loginAsUser();
        $this->visitRoute('participants.index');
        $this->see($participant->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Participant 1 name',
            'description' => 'Participant 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_participant()
    {
        $this->loginAsUser();
        $this->visitRoute('participants.index');

        $this->click(__('participant.create'));
        $this->seeRouteIs('participants.create');

        $this->submitForm(__('participant.create'), $this->getCreateFields());

        $this->seeRouteIs('participants.show', Participant::first());

        $this->seeInDatabase('participants', $this->getCreateFields());
    }

    /** @test */
    public function validate_participant_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('participants.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_participant_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('participants.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_participant_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('participants.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Participant 1 name',
            'description' => 'Participant 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_participant()
    {
        $this->loginAsUser();
        $participant = factory(Participant::class)->create(['name' => 'Testing 123']);

        $this->visitRoute('participants.show', $participant);
        $this->click('edit-participant-'.$participant->id);
        $this->seeRouteIs('participants.edit', $participant);

        $this->submitForm(__('participant.update'), $this->getEditFields());

        $this->seeRouteIs('participants.show', $participant);

        $this->seeInDatabase('participants', $this->getEditFields([
            'id' => $participant->id,
        ]));
    }

    /** @test */
    public function validate_participant_name_update_is_required()
    {
        $this->loginAsUser();
        $participant = factory(Participant::class)->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('participants.update', $participant), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_participant_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $participant = factory(Participant::class)->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('participants.update', $participant), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_participant_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $participant = factory(Participant::class)->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('participants.update', $participant), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_participant()
    {
        $this->loginAsUser();
        $participant = factory(Participant::class)->create();
        factory(Participant::class)->create();

        $this->visitRoute('participants.edit', $participant);
        $this->click('del-participant-'.$participant->id);
        $this->seeRouteIs('participants.edit', [$participant, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('participants', [
            'id' => $participant->id,
        ]);
    }
}
