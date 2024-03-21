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
        Schema::create('payment_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_voucher_id');
            $table->integer('customer_id');
            $table->integer('auth_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->bigInteger('amount')->default(0);
            $table->bigInteger('paid')->default(0);
            $table->bigInteger('due')->default(0);
            $table->integer('status')->default(0);
            $table->string('date');
            $table->string('month');
            $table->integer('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_vouchers');
    }
};
