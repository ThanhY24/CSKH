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
            $table->id("staff_id");
            $table->string("staff_name");
            $table->string("staff_birthday");
            $table->string("staff_gender");
            $table->string("staff_phone");
            $table->string("staff_email");
            $table->string("staff_password");
            $table->string("staff_address");
            $table->string("staff_position");
            $table->string("staff_role");
            $table->string("staff_status");
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
