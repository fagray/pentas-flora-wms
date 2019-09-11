<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobWastesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_wastes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('waste_id');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('unit_id');
            $table->decimal('volume',8,2);
            $table->decimal('volume_collected',8,2)->nullable();
            // $table->enum('matches_with_original_volume',['yes','no'])->nullable()->default('no');
            $table->string('evidence_img_url')->nullable();
            $table->decimal('unit_price',8,2);
            $table->foreign('unit_id')->references('id')->on('units')
                ->onDelete('cascade');
            $table->foreign('waste_id')->references('id')->on('wastes')
                ->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_wastes');
    }
}
