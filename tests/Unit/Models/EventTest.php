<?php

namespace Tests\Unit\Models;

use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider dataTypes
     * @test
     *
     * @return void
     */
    public function testGetTypeNameAttribute()
    {
        foreach ($this->dataTypes() as $type) {
            $event = factory(Event::class)->create(['type' => array_key_first($type)]);
            $this->assertEquals(implode(array_values($type)), $event->type_name);
        }
    }

    /**
     * @dataProvider dataGroupings
     * @test
     *
     * @return void
     */
    public function testGetGroupingNameAttribute()
    {
        foreach ($this->dataGroupings() as $grouping) {
            $event = factory(Event::class)->create(['grouping' => array_key_first($grouping)]);
            $this->assertEquals(implode(array_values($grouping)), $event->grouping_name);
        }
    }

    /**
     * Test model returns the right duration date.
     *
     * @return void
     */
    public function testGetDurationDateAttribute()
    {
        $oneDayEvent = factory(Event::class)->create(['started_at' => now()->toDateString(), 'ended_at' => now()->toDateString()]);
        $sameMonthEvent = factory(Event::class)->create(['started_at' => now()->toDateString(), 'ended_at' => now()->addDays(4)->toDateString()]);
        $differentMonthEvent = factory(Event::class)->create(['started_at' => now()->toDateString(), 'ended_at' => now()->addMonth()->toDateString()]);

        $durationPrefix = now()->monthName . ' ' . now()->day;
        $durationSuffix = ', ' . now()->year;

        $sameDayDuration = $durationPrefix  . $durationSuffix;
        $sameMonthDuration = $durationPrefix . '-' . now()->addDays(4)->day . $durationSuffix;
        $differentMonthDuration = $durationPrefix . ' to ' . now()->addMonth()->monthName . ' ' . now()->addMonth()->day . $durationSuffix;

        $this->assertEquals($sameDayDuration,  $oneDayEvent->duration_date);
        $this->assertEquals($sameMonthDuration, $sameMonthEvent->duration_date);
        $this->assertEquals($differentMonthDuration, $differentMonthEvent->duration_date);
    }

    public function dataGroupings()
    {
        return [
            ['R' => 'By Region'],
            ['L' => 'By Learning Area'],
            ['M' => 'By Language'],
            ['N' => 'No Grouping']
        ];
    }

    public function dataTypes()
    {
        return [
            ['W' => 'Workshop/Writeshop'],
            ['T' => 'Training/Orientation'],
            ['C' => 'Conference/Summit']
        ];
    }
}
