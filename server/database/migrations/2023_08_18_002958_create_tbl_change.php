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
        Schema::create('tbl_change', function (Blueprint $table) {
            $table->id("change_id");
            $table->string("change_des");
            $table->string("change_start_date");
            $table->string("change_expected_date");
            $table->string("change_ratio");
            $table->integer("cus_id");
            $table->integer("staff_id");
            $table->integer("product_id");
            $table->string("change_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_change');
    }
};
