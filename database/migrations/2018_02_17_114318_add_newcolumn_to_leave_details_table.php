<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewcolumnToLeaveDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_details', function (Blueprint $table) {
           $table->string('start_date')->after('days')->nullable();
           $table->string('end_date')->nullable();
             $table->string('confirm_days')->nullable();
           $table->string('confirm_start_date')->nullable();
             $table->string('confirm_end_date')->nullable();
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_details', function (Blueprint $table) {
            //
        });
    }
}
