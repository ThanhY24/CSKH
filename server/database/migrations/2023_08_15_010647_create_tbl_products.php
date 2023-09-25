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
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->id("products_id");
            $table->string("products_name");
            $table->string("products_image");
            $table->string("products_des");
            $table->string("products_cost");
            $table->string("products_syntax");
            $table->string("products_duration");
            $table->integer("products_vat");
            $table->integer("ser_id");
            $table->string("products_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_products');
    }
};
