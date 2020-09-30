<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_item', function (Blueprint $table) {
            $table->id('sale_item_id');
            $table->foreignId('sale_info_id');
            $table->foreignId('product_info_id');
            $table->foreignId('inventory_id');
            $table->string('barcode', 200);
            $table->decimal('sale_price', 8, 2);            
            $table->integer('qty');
            // $table->string('entry_by', 50);
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
        Schema::dropIfExists('sale_item');
    }
}
