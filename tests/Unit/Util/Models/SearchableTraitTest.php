<?php

namespace Tests\Unit\Util\Models;

use App\BaseModel;
use App\Event;
use Tests\TestCase;
use App\Participant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchableTraitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if participants can be searched.
     *
     * @return void
     */
    public function testParticipantSearch()
    {
        $data = [
            'last_name' => 'Bartolome',
            'mobile' => '99998887766'
        ];

        $this->executeSearchTest($data, new Participant());
    }

    /**
     * Test if events can be searched.
     *
     * @return void
     */
    public function testEventSearch()
    {
        $data = [
            'title' => 'Vocal Lounge Conference',
        ];

        $this->executeSearchTest($data, new Event());
    }

    private function executeSearchTest(array $data, BaseModel $model)
    {
        $class = get_class($model);
        factory($class, 5)->create();
        factory($class)->create($data);
        $results = $model->search(implode(', ', $data))->get()->toArray();

        $this->assertEquals(1, count($results));
        foreach ($data as $key => $value) {
            $this->assertContains($value, $results[0]);
        }
    }
}
