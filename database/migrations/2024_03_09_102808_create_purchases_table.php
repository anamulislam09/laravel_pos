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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('auth_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('category_id');
            $table->string('purchase_invoice_id');
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->integer('product_unit')->nullable();
            $table->bigInteger('product_unit_per_rate')->nullable();
            $table->bigInteger('total_price_without_discount')->nullable();
            $table->integer('discount')->nullable();
            $table->bigInteger('discount_price')->nullable();
            $table->bigInteger('total_price_after_discount')->nullable();
            $table->bigInteger('paid')->default(0);
            $table->bigInteger('due')->default(0);
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
        Schema::dropIfExists('purchases');
    }
};
