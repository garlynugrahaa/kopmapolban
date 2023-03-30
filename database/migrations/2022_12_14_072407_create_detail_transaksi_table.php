<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_product');
            $table->float('price_buy', 20, 2, true);
            $table->bigInteger('qty');
            $table->float('subtotal', 20, 2, true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_product')->references('product_id')->on('products');
            $table->foreign('id_transaksi')->references('id')->on('transaksi');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
