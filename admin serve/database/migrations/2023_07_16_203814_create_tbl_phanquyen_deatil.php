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
        Schema::create('tbl_phanquyen_deatil', function (Blueprint $table) {
            $table->increments('phanquyenDeatil_Id');
            $table->integer('phanquyen_id');
            $table->string('phanquyenDeatil_name');
            $table->string('phanquyenDeatil_note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phanquyen_deatil');
    }
};
