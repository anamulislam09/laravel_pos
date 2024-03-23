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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('auth_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('sales_collection_id')->default(0);
            $table->string('sales_invoice_id')->default(0);
            $table->decimal('amount', 13, 2)->default(0);
            $table->string('date');
            $table->string('month');
            $table->integer('year');
            $table->integer('collection_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
