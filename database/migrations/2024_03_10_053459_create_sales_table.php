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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('auth_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('sales_invoice_id')->nullable();
            $table->integer('category_id');
            $table->string('product_id');
            $table->decimal('sales_item_quantity', 13, 2)->nullable();
            $table->decimal('sales_item_rate', 13, 2)->nullable();
            $table->decimal('sales_item_discount', 13, 2)->nullable();
            $table->decimal('amount', 13, 2)->nullable();
            $table->decimal('amount_after_discount', 13, 2)->nullable();
            $table->string('date');
            $table->string('month');
            $table->integer('year');
            $table->integer('sales_invoice_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
