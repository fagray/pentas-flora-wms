<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_list_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('price_list_id');
            $table->unsignedBigInteger('waste_id');
            $table->unsignedBigInteger('unit_id');
            $table->decimal('unit_price',8,2)->default(0.00);
            $table->timestamps();

            $table->foreign('price_list_id')->references('id')->on('price_lists')
                ->onDelete('cascade');
            $table->foreign('waste_id')->references('id')->on('wastes')
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
        Schema::dropIfExists('price_list_items');
    }
}
