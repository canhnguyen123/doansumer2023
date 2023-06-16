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
        Schema::create('tbl_theloai', function (Blueprint $table) {
            $table->increments('theloai_id'); // Cột tự động tăng làm khóa chính
            $table->integer('category_code');
            $table->integer('phanloai_code');
            $table->string('theloai_name');
            $table->string('theloai_link_img');
            $table->integer('theloai_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_theloai');
    }
};
