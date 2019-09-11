<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            // $table->unsignedBigInteger('processing_centre_id');
            $table->decimal('amount_paid',8,2)->default(0.00);
            $table->enum('mode',['Cash','Bank','Cheque']);
            $table->string('cheque_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('deposit_slip_no')->nullable();
            $table->timestamp('payment_date');
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')
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
        Schema::dropIfExists('invoice_payments');
    }
}
