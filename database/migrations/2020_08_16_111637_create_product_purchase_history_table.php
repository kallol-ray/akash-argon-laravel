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
            $table->foreignId('purchase_order_info_id');
            $table->foreignId('product_info_id');
            $table->string('barcode', 100)->unique();
            $table->tinyInteger('quantity')->comment('1=defaut and always');
            $table->decimal('buy_price', 8, 2);
            $table->date('buy_date');
            $table->boolean('is_stored');
            $table->string('entry_by', 50);
            $table->string('comment', 200);
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
