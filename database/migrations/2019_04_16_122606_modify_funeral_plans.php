<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFuneralPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funeral_plans', function (Blueprint $table) {
            //
            $table->integer('number_of_children')->default(0);
            $table->integer('number_of_dependents')->default(0)->change();
            $table->boolean('policy_holder_covered')->default(true);
            $table->boolean('spouse_covered')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funeral_plans', function (Blueprint $table) {
            //
        });
    }
}
