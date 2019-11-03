<?php

use Illuminate\Database\Seeder;

class ParticipantRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ParticipantRole::class, 5)->create();
    }
}
