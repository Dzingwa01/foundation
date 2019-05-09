<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('name');
            $table->string('surname');
            $table->string('email')->nullable();
            $table->string('gender');
            $table->string('national_id_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('relationship')->nullable();
            $table->boolean('is_covered')->nullable();
            $table->string('contact_number')->nullable();
            $table->uuid('policy_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('policy_id')->references('id')->on('policies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nominees');
    }
}
