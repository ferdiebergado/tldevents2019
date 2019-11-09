<?php

namespace Tests\Unit\Models;

use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipantTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test if last_name attribute is saved in title case.
     *
     * @return void
     */
    public function testSetLastNameAttribute()
    {
        $last_name = 'BERGADO';

        $participant = factory(Participant::class)->create(compact('last_name'));

        $this->assertEquals(ucfirst($last_name), $participant->last_name);
    }

    /**
     * Test if first_name attribute is saved in title case.
     *
     * @return void
     */
    public function testSetFirstNameAttribute()
    {
        $first_name = 'FERDINAND';

        $participant = factory(Participant::class)->create(compact('first_name'));

        $this->assertEquals(ucfirst($first_name), $participant->first_name);
    }

    /**
     * Test if mi attribute is capitalized and period is removed.
     *
     * @return void
     */
    public function testSetMiAttribute()
    {
        $mi = 's';
        $mi2 = 's.';

        $participant = factory(Participant::class)->create(compact('mi'));
        $participant2 = factory(Participant::class)->create(['mi' => $mi2]);

        $this->assertEquals(strtoupper(str_replace('.', '', $mi)), $participant->mi);
        $this->assertEquals(strtoupper(str_replace('.', '', $mi2)), $participant2->mi);
    }

    /**
     * Test if mobile attribute is stringified from array.
     *
     * @return void
     */
    public function testGetMobileAttribute()
    {
        $mobile = '99998887766';
        $mobile2 = '99998887766, 12345678909';

        $participant = factory(Participant::class)->create(compact('mobile'));
        $participant2 = factory(Participant::class)->create(['mobile' => $mobile2]);

        $this->assertEquals($this->stringify($mobile), $participant->mobile);
        $this->assertEquals($this->stringify(json_encode($mobile2)), $participant2->mobile);
    }

    /**
     * Test if email attribute is stringified from array.
     *
     * @return void
     */
    public function testGetEmailAttribute()
    {
        $email = $this->faker->email;
        $emails = '{$this->faker->email}, {$this->faker->email}';

        $participant = factory(Participant::class)->create(compact('email'));
        $participant2 = factory(Participant::class)->create(['email' => $emails]);

        $this->assertEquals($this->stringify(json_encode($email)), $participant->email);
        $this->assertEquals($this->stringify(json_encode($emails)), $participant2->email);
    }

    private function stringify($value)
    {
        if (null === $value) {
            return $value;
        }

        $str = json_decode($value);

        return implode(', ', (array) $str);
    }
}
