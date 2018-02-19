<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewcolumToActivityFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_flows', function (Blueprint $table) {
            $table->integer('reject_status');
            $table->integer('approved_status');
            $table->integer('edit_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_flows', function (Blueprint $table) {
            $table->dropColumn('reject_status');
            $table->dropColumn('approved_status');
            $table->dropColumn('edit_status');
        });
    }
}
