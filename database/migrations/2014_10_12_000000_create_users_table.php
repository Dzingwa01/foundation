<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('employee_code')->unique();
            $table->string('name');
            $table->string('surname');
            $table->date('dob')->nullable();
            $table->string('contact_number');
            $table->string('contact_number_two')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('account_status')->nullable();
            $table->string('profile_picture_url')->nullable();
            $table->string('password');
            $table->uuid('branch_id');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
