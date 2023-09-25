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
        Schema::create('tbl_quotation', function (Blueprint $table) {
            $table->id("quotation_id")->nullable();
            $table->string("quotation_created_date");
            $table->string("quotation_due_date");
            $table->string("quotation_des")->nullable();
            $table->integer("staff_id");
            $table->integer("cus_id");
            $table->string("quotation_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_quotation');
    }
};
