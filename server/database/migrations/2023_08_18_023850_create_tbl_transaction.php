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
        Schema::create('tbl_transaction', function (Blueprint $table) {
            $table->id("transaction_id")->nullable();
            $table->string("transaction_name");
            $table->string("transaction_des")->nullable();
            $table->string("transaction_evaluation")->nullable();
            $table->string("transaction_note")->nullable();
            $table->string("transaction_start_date");
            $table->string("transaction_deadline_date");
            $table->string("transaction_completion_date")->nullable();
            $table->string("transaction_result_id")->nullable();
            $table->integer("staff_id")->nullable();
            $table->integer("cus_id")->nullable();
            $table->integer("change_id")->nullable();
            $table->string("transaction_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transaction');
    }
};
