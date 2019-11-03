<?php

use App\Event;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Event::class, 10)->create();
        $event = Event::latest()->first();
        $event->update(['created_by' => 1, 'updated_by' => 1, 'is_active' => true]);
    }
}
