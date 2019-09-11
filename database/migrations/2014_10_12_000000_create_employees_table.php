<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('license_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('street')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('role')->default('guest')->nullable();
            $table->unsignedBigInteger('processing_centre_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('processing_centre_id')->references('id')->on('processing_centres')
                ->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('employees');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
