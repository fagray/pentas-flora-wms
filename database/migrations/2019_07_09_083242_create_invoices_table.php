<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('inv_no');
            $table->string('ref_no');
            $table->timestamp('due_date');
            $table->enum('status',['Pending','Partially Paid','Paid','Overpaid']);
            $table->decimal('total_amount',8,2)->default(0.00);
            $table->decimal('balance_amount',8,2)->default(0.00);
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')
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
        Schema::dropIfExists('invoices');
    }
}
