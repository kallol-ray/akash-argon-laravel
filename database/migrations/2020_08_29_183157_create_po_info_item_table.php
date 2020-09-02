<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoInfoItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_info_item', function (Blueprint $table) {
            $table->id('po_info_item_id');
            $table->foreignId('product_info_id');
            $table->string('auto_invoice_no', 50);
            $table->string('image', 200);
            $table->integer('product_qty');
            $table->decimal('unit_price', 8, 2);
            $table->decimal('unit_adnl_price', 8, 2);
            $table->decimal('sale_price', 8, 2);
            $table->decimal('total_price', 8, 2);
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
        Schema::dropIfExists('po_info_item');
    }
}
