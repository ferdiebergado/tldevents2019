<?php

use Illuminate\Database\Seeder;

class LearningAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\LearningArea::class, 10)->create();
    }
}
