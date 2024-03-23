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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->integer('customer_id');
            $table->integer('auth_id')->nullable();
            $table->integer('category_id');
            $table->string('product_name');
            $table->string('quantity_status')->nullable();
            $table->string('month');
            $table->integer('year');
            $table->string('date');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
