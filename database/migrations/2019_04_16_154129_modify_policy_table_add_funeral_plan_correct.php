<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPolicyTableAddFuneralPlanCorrect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('policies', function (Blueprint $table) {
            //
            $table->uuid('funeral_plan_id')->nullable();

            $table->foreign('funeral_plan_id')->references('id')->on('funeral_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('policies', function (Blueprint $table) {
            //
            $table->dropColumn('funeral_plan_id');
        });
    }
}
