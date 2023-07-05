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
        Schema::create('tbl_phanloai', function (Blueprint $table) {
            $table->increments('phanloai_id');
            $table->string('phanloai_name');
            $table->string('phanloai_code');
            $table->integer('phanloai_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_phanloai');
    }
};
