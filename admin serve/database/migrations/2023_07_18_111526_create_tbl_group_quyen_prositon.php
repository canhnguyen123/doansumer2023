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
        Schema::create('tbl_groupQuyen_prosition', function (Blueprint $table) {
            $table->id('groupId');
            $table->integer('chucvu_id');
            $table->integer('phanquyen_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_groupQuyen_prosition');
    }
};
