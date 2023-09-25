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
        Schema::create('tbl_customer', function (Blueprint $table) {
            $table->id("cus_id");
            $table->string("cus_name")->nullable();
            $table->string("cus_birthday");
            $table->string("cus_gender");
            $table->string("cus_phone");
            $table->string("cus_email");
            $table->string("cus_password");
            $table->string("cus_total_cost");
            $table->string("cus_taxID");
            $table->string("cus_address");
            $table->string("cus_address_ship");
            $table->string("cus_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_customer');
    }
};
