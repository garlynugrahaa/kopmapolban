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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->unsignedBigInteger('product_category_id');
            $table->string('id')->unique();
            $table->string('product_name');
            $table->bigInteger('product_stock');
            $table->float('product_price', 20, 2, true);
            $table->longText('product_desc');
            $table->string('product_slug')->unique();
            $table->date('product_exp');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_category_id')->references('product_category_id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
