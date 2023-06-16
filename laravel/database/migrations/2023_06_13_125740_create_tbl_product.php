<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_id');
            $table->integer('phanloai_id');
            $table->integer('theloai_id');
            $table->integer('brand_id');
            $table->integer('status_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->double('product_price');
            $table->text('product_dacdiem');
            $table->text('product_mota');
            $table->text('product_baoquan');
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_product');
    }
};
