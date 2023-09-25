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
        Schema::create('tbl_invoices_item', function (Blueprint $table) {
            $table->id("invoices_item_id")->nullable();
            $table->integer("invoices_id");
            $table->integer("invoices_item_quantity");
            $table->integer("invoices_item_vat");
            $table->integer("products_id");
            $table->integer("products_cost");
            $table->string("invoices_item_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_invoices_item');
    }
};
