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
        Schema::create('tbl_hoadon', function (Blueprint $table) {
            $table->increments("hoadon_id");
            $table->string("user_id");
            $table->string("hoadon_code");
            $table->double("hoadon_allprice");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_hoadon');
    }
};
