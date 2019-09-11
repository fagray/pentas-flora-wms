<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();
            
            $table->foreign('area_id')->references('id')->on('areas')
                ->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
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
        Schema::dropIfExists('area_employees');
    }
}
