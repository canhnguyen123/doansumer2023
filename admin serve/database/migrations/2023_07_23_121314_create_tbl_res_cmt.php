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
        Schema::create('tbl_res_cmt', function (Blueprint $table) {
            $table->increments('res_cmt_id');
            $table->integer('cmt_id');
            $table->integer('user_id');
            $table->text('res_cmt_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_res_cmt');
    }
};
