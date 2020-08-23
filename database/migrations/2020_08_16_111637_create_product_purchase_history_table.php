<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchaseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchase_history', function (Blueprint $table) {
            $table->id('pp_history_id');
            $table->foreignId('product_id');
            $table->string('barcode', 200)->unique();
            $table->decimal('buy_price', 8, 2);
            $table->date('buy_date');
            $table->bigInteger('purchase_invoice_number');
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
        Schema::dropIfExists('product_purchase_history');
    }
}
