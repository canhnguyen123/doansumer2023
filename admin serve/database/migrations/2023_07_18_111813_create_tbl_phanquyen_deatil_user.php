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
        Schema::create('tbl_phanquyenDeatil_user', function (Blueprint $table) {
            $table->id('phanquyenDeatil_user_Id');
            $table->integer('id');
            $table->integer('phanquyenDeatil_Id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phanquyenDeatil_user');
    }
};
