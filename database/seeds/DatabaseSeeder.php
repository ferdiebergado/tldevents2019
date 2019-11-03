<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProgramsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(ParticipantsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(LearningAreasTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
    }
}
