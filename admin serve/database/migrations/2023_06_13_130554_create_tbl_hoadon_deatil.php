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
        Schema::create('tbl_hoadon_deatil', function (Blueprint $table) {
            $table->increments("hoadondeatil_id");
            $table->integer("hoandon_id");
            $table->integer("product_id");
            $table->integer("hoadondeatil_quantyti");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_hoadon_deatil');
    }
};
