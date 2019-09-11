<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('waste_id');
            $table->decimal('volume',8,2);
            $table->decimal('price',8,2)->default(0.00);
            // $table->morphs('costcenter');
            $table->unsignedBigInteger('unit_id');
            
            $table->timestamps();

            $table->foreign('waste_id')->references('id')->on('wastes')
                ->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')
                ->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')
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
        Schema::dropIfExists('invoice_items');
    }
}
