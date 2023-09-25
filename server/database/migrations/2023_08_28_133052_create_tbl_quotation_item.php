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
        Schema::create('tbl_quotation_item', function (Blueprint $table) {
            $table->id("quotation_item_id")->nullable();
            $table->integer("quotation_id");
            $table->integer("quotation_item_quantity");
            $table->integer("quotation_item_vat");
            $table->string("quotation_products_cost");
            $table->integer("products_id");
            $table->string("quotation_item_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_quotation_item');
    }
};
