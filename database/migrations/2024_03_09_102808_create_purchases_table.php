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
            $table->string('purchase_voucher_id');
            $table->string('product_id');
            $table->integer('product_quantity')->nullable();
            $table->decimal('product_unit_per_rate', 13, 2)->nullable();
            $table->decimal('total_price_without_discount', 13, 2)->nullable();
            $table->decimal('discount', 13, 2)->nullable();
            $table->decimal('discount_price', 13, 2)->nullable();
            $table->decimal('total_price_after_discount', 13, 2)->nullable();
            $table->decimal('paid', 13, 2)->default(0);
            $table->decimal('due', 13, 2)->default(0);
            $table->string('product_thumbnail')->nullable();
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
