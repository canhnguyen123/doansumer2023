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
        Schema::create('tbl_vocher', function (Blueprint $table) {
            $table->increments("voucher_id");
            $table->string("voucher_code",15);
            $table->string("voucher_name");
            $table->text("voucher_context");
            $table->double("voucher_down");
            $table->integer("voucher_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_vocher');
    }
};
