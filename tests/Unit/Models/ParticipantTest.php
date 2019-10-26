<?php

namespace Tests\Unit\Models;

use App\User;
use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class ParticipantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_participant_has_name_link_attribute()
    {
        $participant = factory(Participant::class)->create();

        $title = __('app.show_detail_title', [
            'name' => $participant->name, 'type' => __('participant.participant'),
        ]);
        $link = '<a href="'.route('participants.show', $participant).'"';
        $link .= ' title="'.$title.'">';
        $link .= $participant->name;
        $link .= '</a>';

        $this->assertEquals($link, $participant->name_link);
    }

    /** @test */
    public function a_participant_has_belongs_to_creator_relation()
    {
        $participant = factory(Participant::class)->make();

        $this->assertInstanceOf(User::class, $participant->creator);
        $this->assertEquals($participant->creator_id, $participant->creator->id);
    }
}
