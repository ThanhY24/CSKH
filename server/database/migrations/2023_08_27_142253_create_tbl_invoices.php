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
        Schema::create('tbl_invoices', function (Blueprint $table) {
            $table->id("invoices_id")->nullable();//
            $table->string("invoices_date");//
            $table->string("due_date");//
            $table->string("invoices_total_amount", 10, 2);//
            $table->string("payment_method");//
            $table->integer("staff_id");//
            $table->integer("cus_id");//
            $table->string("invoices_status");//
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_invoices');
    }
};
