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
        Schema::create('tbl_staff', function (Blueprint $table) {
            $table->increments('staff_id');
            $table->string('staff_code',10);
            $table->string('staff_username');
            $table->string('staff_password');
            $table->string('staff_fullname');
            $table->string('staff_email');
            $table->integer('chucvu_id');
            $table->text('staff_linkimg');
            $table->text('staff_note');
            $table->integer('staff_status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_staff');
    }
};
