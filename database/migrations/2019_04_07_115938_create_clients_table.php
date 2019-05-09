<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('name');
            $table->string('surname');
            $table->string('email')->nullable();
            $table->string('landline')->nullable();
            $table->string('gender');
            $table->string('national_id_number')->nullable();

            $table->date('date_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('name_of_company')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('cell_number')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
