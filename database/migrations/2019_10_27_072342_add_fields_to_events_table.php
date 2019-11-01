<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->char('grouping')->comment('R: By Region; L: By LearningArea; M: By Language');
            $table->char('type')->comment('W: Workshop/Writeshop; T: Training; C: Conference/Summits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('grouping');
            $table->dropColumn('type');
        });
    }
}
