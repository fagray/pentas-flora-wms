<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('price_list_id')->nullable();
            // $table->unsignedBigInteger('processing_centre_id')->nullable();
            $table->enum('agreement_type',['monthly','adhoc','partial','pro-forma']);
            $table->timestamp('collection_date')->nullable();
            $table->timestamp('collected_at')->nullable();
            $table->enum('status',['Open','Assigned','Completed','Verified'])->nullable()->default('Open');
            $table->string('notes')->nullable();
            $table->morphs('costcenter');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade');
            $table->foreign('price_list_id')->references('id')->on('price_lists')
                ->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')
                ->onDelete('cascade');
            // $table->foreign('processing_centre_id')->references('id')->on('processing_centres')
            //     ->onDelete('cascade');
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
        Schema::dropIfExists('jobs');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
