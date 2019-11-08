<?php

namespace Tests\Unit\Util\Models;

use App\Participant;
use App\User;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStampTraitTest extends AbstractTestCase
{
    use WithFaker;

    /**
     * Test userstamps are created on new model creation.
     *
     * @return void
     */
    public function testCreating()
    {
        $participant = factory(Participant::class)->create();

        $this->assertEquals($this->user->id, $participant->created_by);
        $this->assertInstanceOf(User::class, $participant->creator);
        $this->assertEquals($this->user->name, $participant->creator->name);
        $this->assertEquals($this->user->id, $participant->updated_by);
        $this->assertInstanceOf(User::class, $participant->editor);
        $this->assertEquals($this->user->name, $participant->editor->name);
    }

    /**
     * Test userstamps are updated on model update.
     *
     * @return void
     */
    public function testUpdating()
    {
        $participant = factory(Participant::class)->create();
        $user = factory(User::class)->states(['active', 'encoder'])->create();

        $this->be($user);

        $participant->update(['email' => $this->faker->email]);

        $this->assertEquals($user->id, $participant->updated_by);
        $this->assertEquals($user->name, $participant->editor->name);
    }

    /**
     * Test userstamps are updated on model delete.
     *
     * @return void
     */
    public function testDeleting()
    {
        $participant = factory(Participant::class)->create();
        $user = factory(User::class)->states(['active', 'encoder'])->create();

        $this->be($user);

        $participant->delete();

        $this->assertEquals($user->id, $participant->deleted_by);
        $this->assertEquals($user->name, $participant->destroyer->name);
    }
}
