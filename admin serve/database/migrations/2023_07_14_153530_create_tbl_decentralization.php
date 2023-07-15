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
        Schema::create('tbl_decentralization', function (Blueprint $table) {
            $table->increments('decentralization_id');
            $table->string('decentralization_name');
            $table->string('decentralization_describe');
            $table->integer('decentralization_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_decentralization');
    }
};
